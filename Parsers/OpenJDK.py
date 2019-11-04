#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *
import re

class OpenJDK(Parser):
    def parse(self):
        HTML = getWebsite("https://adoptopenjdk.net/release_notes.html")
        soup = BeautifulSoup(HTML,"lxml")
        DIV = soup.find('div', attrs={"class": "align-left support"})

        anchor = DIV.find_all('div', attrs={"class": "anchor"})
        H2=list()
        for x in anchor:
            H2=H2+x.find_all('h2')

        Margins = DIV.find_all('div', attrs={"class": "margin-bottom"})
        UL=list()
        for x in Margins:
            UL=UL+x.find_all('ul')

        # Start a new list to store all results dictionary.
        parseResult = list()

        # Loop all <h3> and <li>
        # Skip the first element.
        for i in range(1, len(H2)):
            # find all <li>
            LI = UL[i].find_all("li")

            # create a dict to store this udate info.
            record = dict()
            record['version'] = H2[i].text.replace("OpenJDK ", "").split(" ")[0]
            # If no time info is given
            record['time'] = "None"
            record['content'] = [li.text.replace("\n", "") for li in LI]

            # Append this record to the result list.
            parseResult.append(record)

        # return the final result.
        return (getJSONStr(parseResult))


if __name__ == '__main__':
    test = OpenJDK()
    test.start()
    test.join()
    print(test)









