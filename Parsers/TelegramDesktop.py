#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *

class TelegramDesktop(Parser):
    def parse(self):
        HTML = getWebsite("https://desktop.telegram.org/changelog")
        soup = BeautifulSoup(HTML,"lxml")
        DIV = soup.find('div', attrs={"id": "dev_page_content"})
        H3 = DIV.find_all("h3")
        UL = DIV.find_all("ul")

        # New list for store results.
        parseResult = list()

        # Loop all <h3>
        for i in range(0, len(H3)):
            # find all <li>
            LI = UL[i].find_all("li")

            # start a new dict to store this update info.
            record = dict()
            record['version'] = H3[i].text.replace("v ", "").split(" ")[0]
            record['time'] = H3[i].text.replace("v ", "").split(" ")[1]
            record['content'] = [li.text.replace("\n", "") for li in LI]

            # append to result list.
            parseResult.append(record)

        # Result the result list.
        return (getJSONStr(parseResult))



if __name__ == '__main__':
    # For testing usage.
    testTelegramDesktop = TelegramDesktop()
    testTelegramDesktop.start()
    testTelegramDesktop.join()
    print(testTelegramDesktop)
