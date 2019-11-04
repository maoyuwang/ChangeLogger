#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *


class TelegramMac(Parser):
    def parse(self):
        # Get the source code of the page.
        HTML = getWebsite("https://macos.telegram.org/")

        # Generate a soup object.
        soup = BeautifulSoup(HTML, "lxml")

        # find "dev_page_content" div
        DIV = soup.find('div', attrs={"id": "dev_page_content"})

        # find all <h3> and <ul>
        H3 = DIV.find_all('h3')
        UL = DIV.find_all('ul')

        # Start a new list for storing all results.
        parseResult = list()

        # Loop all <h3> and <ul>
        for i in range(0, len(H3)):
            # find all <li>
            LI = UL[i].find_all("li")

            # start a new dict for storing update info.
            record = dict()
            record['version'] = H3[i].text.replace("v ", "").split(" ")[0]
            record['time'] = H3[i].text.replace("v ", "").split(" ")[1]
            record['content'] = [li.text.replace("\n", "") for li in LI]

            # append this record to the result list.
            parseResult.append(record)

        # return the final result list.
        return (getJSONStr(parseResult))


if __name__ == '__main__':
    # Start a new parser for TelegramMac
    testTelegramMac = TelegramMac()

    # Start parser thread.
    testTelegramMac.start()

    # Wait for join.
    testTelegramMac.join()

    # print Result.
    print(getFormattedString(testTelegramMac.getResult()))
