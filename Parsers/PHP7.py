#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *
import re

class php7(Parser):
    def parse(self):
        HTML = getWebsite("https://www.php.net/ChangeLog-7.php")
        soup = BeautifulSoup(HTML,"lxml")
        DIV = soup.find('div', attrs={"id": "layout"})
        content = DIV.find('section', attrs={"id": "layout-content"})
        anchor = content.find_all('section', attrs={"class": "version"})
        H3=list()
        UL=list()
        time=list()
        for x in anchor:
            H3=H3+x.find_all('h3')
            UL=UL+x.find_all('ul')
            time_tmp=x.find('time',attrs={"class":"releasedate"})
            time.append(time_tmp["datetime"])
        # New list for store result dicts.
        parseResult = list()

        # Loop all <h3>
        for i in range(0, len(H3)):
            # find all <li>
            LI = UL[i].find_all("li")

            # Create a new dict for store info.
            record = dict()
            record['version'] = H3[i].text.split(" ")[-1]
            record['time'] = time[i]
            record['content'] = [li.text.replace("\n", "") for li in LI]

            # Append this update to the result list
            parseResult.append(record)

        # Return final result.
        return (getJSONStr(parseResult))


if __name__ == '__main__':
    test = php7()
    test.start()
    test.join()
    print(test)









