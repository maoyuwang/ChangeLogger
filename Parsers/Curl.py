#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *
import re

class Curl(Parser):
    def parse(self):
        HTML = getWebsite("https://curl.haxx.se/changes.html")
        soup = BeautifulSoup(HTML,"lxml")
        DIV = soup.find('div', attrs={"class": "contents"})
        H3 = DIV.find_all("h2")
        UL= DIV.find_all("ul")
        # Creat an empty list to store results.
        parseResult = list()

        # Loop all <h3> and <ul>
        for i in range(0, len(H3)):
            # Find all <li>
            LI = UL[i].find_all("li")

            # Create a dict to store this update
            record = dict()

            record['version'] = H3[i].text.replace("Fixed in ", "").split(" ")[1]
            splitedHeader = H3[i].text.split(" - ")
            if len(splitedHeader)== 2:
                record['time'] = splitedHeader[-1]
            else:
                record['time'] = "None"

            record['content'] = [li.text.replace("\n", "") for li in LI]

            # Append this update info to result list
            parseResult.append(record)

        # return the final result.
        return (getJSONStr(parseResult))


if __name__ == '__main__':
    test = Curl()
    test.start()
    test.join()
    print(test.result)
    print(test)









