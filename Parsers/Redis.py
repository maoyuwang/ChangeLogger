#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *
import re


class Redis(Parser):

    def parse(self):

        # get the website's source code
        HTML = getWebsite("https://raw.githubusercontent.com/nodejs/node/master/doc/changelogs/CHANGELOG_V10.md")

        # put the source code into soup object
        # Updates = BeautifulSoup(HTML, "lxml")

        parseResult = list()

        all_version_and_date = re.findall("## +\d+-\d+-\d+, +Version [\d.]+ ", HTML)

        for version_and_date in all_version_and_date:
            record = dict()
            record['version'] = re.search("Version ([\d.]+)", version_and_date).group(1)
            record['time'] = re.search("(\d+-\d+-\d+)", version_and_date).group(1)
            record['content'] = list()

            features = re.escape(version_and_date) + r"[\s\S]*?Notable Changes([\s\S]*?)(?=###)"

            features_in_str = re.findall(features, HTML)
            if len(features_in_str) == 0: continue
            #print(features_in_str)
            features_in_list = list()

            features_in_list = re.findall(": ([\s\S]*?) \[#\d+\]|\n +\*([\s\S]*?) \[#\d+\]", features_in_str[0])
            #print(features_in_list)
            for i in range(len(features_in_list)):
                if features_in_list[i][0] == "":
                    features_in_list[i] = features_in_list[i][1]
                else :
                    features_in_list[i] = features_in_list[i][0]

            record['content'] = features_in_list
            parseResult.append(record)

        return getJSONStr(parseResult)


if __name__ == '__main__':
    testRust = Redis()
    testRust.start()
    testRust.join()
    print(testRust)