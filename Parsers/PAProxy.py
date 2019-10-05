from Parsers.Parser import *
import re
class HAProxy(Parser):

    def parse(self):

        #get the website's source code
        HTML = getWebsite("https://www.haproxy.org/download/1.8/src/CHANGELOG")

        #put the source code into soup object
        #Updates = BeautifulSoup(HTML, "lxml")

        parseResult = list()

        all_version_and_date = re.findall("\d+\/\d+\/\d+\s*:\s*[\w\.-]*\n",HTML)

        for version_and_date in all_version_and_date:
            record = dict()
            record['version'] = re.search(":\s*([\w\.-]*)\n",version_and_date).group(1)
            if record['version'] == "" : continue

            record['time'] = re.search("^\d+\/\d+\/\d+",version_and_date).group(0)
            record['content'] = list()
            features = re.escape(version_and_date) + r"[\s\S]*?\n\n"

            features_in_str = re.findall(features,HTML)
            if len(features_in_str)==0 : continue


            features_in_list = re.findall("\s+-\s*([\s\S]*?)(?=\s-|\n\n)",features_in_str[0])

            #make it one line for each feature
            for i in range(len(features_in_list)):
                features_in_list[i] = re.sub(r"\n\s+"," ",features_in_list[i])

            record['content'] = features_in_list

            parseResult.append(record)
        

        return getJSONStr(parseResult)

if __name__ == '__main__':
    testHAProxy = HAProxy()
    testHAProxy.start()
    testHAProxy.join()
    print(testHAProxy)