#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *
import re

class ApacheTomcat(Parser):
    def parse(self):
        HTML = getWebsite("http://tomcat.apache.org/tomcat-9.0-doc/changelog.html")
        soup = BeautifulSoup(HTML,"lxml")
        DIV = soup.find('div', attrs={"id": "middle"}).find('div', attrs={"id": "mainRight"})
        content = DIV.find('div', attrs={"id": "content"})
        H3=content.find_all('h3')
        UL = content.find_all('div', attrs={"class": "text"})
        time=content.find_all('span', attrs={"style": "float: right;"})

        # Create a new list to store results
        parseResult = list()

        # Loop all <h3> and <ul>
        # Skip the first element because it's description text.
        for i in range(0, len(H3)):
            # find all <li> in this <ul> block.
            LI = UL[i].find_all("li")

            # Create dictionary to store this result.
            record = dict()
            record['version'] = H3[i].text
            # If no time information is given.
            if(i==0):
                record['time'] = "None"
            else:
                record['time'] = time[i-1].text
            record['content'] = [li.text.replace("\n", "").replace("       ","") for li in LI]

            # Append this update to the result list.
            parseResult.append(record)

        # return the final result.
        return (getJSONStr(parseResult))


if __name__ == '__main__':
    # Tests
    test = ApacheTomcat()
    test.start()
    test.join()
    print(test)









