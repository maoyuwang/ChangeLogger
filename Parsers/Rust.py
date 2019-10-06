#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *
import re
class Rust(Parser):

    def parse(self):

        #get the website's source code
        HTML = getWebsite("https://raw.githubusercontent.com/rust-lang/rust/master/RELEASES.md")

        #put the source code into soup object
        #Updates = BeautifulSoup(HTML, "lxml")

        parseResult = list()
        
        all_version_and_date = re.findall("Version [\d.]+ \(\d+-\d+-\d+\)\n",HTML)

        #print(all_version_and_date)
        
        for version_and_date in all_version_and_date:
            record = dict()
            record['version'] = re.search("Version ([\d\.]+) ",version_and_date).group(1)
            record['time'] = re.search("\((\d+-\d+-\d+)\)",version_and_date).group(1)
            record['content'] = list()

            #print(record['version'])
            #print(record['time'])
            
            
            features = re.escape(version_and_date) + r"([\s\S]*?)(?=Version)"

            features_in_str = re.findall(features,HTML)
            if len(features_in_str)==0 : continue

            #print(features_in_str)
            features_in_list = list()

            if record['version'] > "1.17.0":
                features_in_list = re.findall("-\s+([\s\S]*?)(?= {4,}\*|\n\n)",features_in_str[0])
            else :
                features_in_list = re.findall("\*\s*([\s\S]*?)(?= {4,}\*|\n\n)",features_in_str[0])

            #make it one line for each feature
            for i in range(len(features_in_list)):
                features_in_list[i] = re.sub(r"\n\s*"," ",features_in_list[i])

            record['content'] = features_in_list
            
            

            parseResult.append(record)
        

        return getJSONStr(parseResult)
        

if __name__ == '__main__':
    testRust = Rust()
    testRust.start()
    testRust.join()
    print(testRust)