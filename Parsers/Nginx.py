from Parsers.Parser import *
import re
class Nginx(Parser):

    def parse(self):

    	#get the website's source code
        HTML = getWebsite("http://nginx.org/en/CHANGES")

        #put the source code into soup object
        Updates = BeautifulSoup(HTML, "lxml")

        parseResult = list()

        keyword = "Changes with nginx"
        all_version_and_date = re.findall("(Changes with nginx.*)\n",HTML)

        for version_and_date in all_version_and_date:
            record = dict()
            record['version'] = re.search("Changes with nginx\s*([\d\.]+)",version_and_date).group(1)
            record['time'] = re.search("(\w+\s\w+\s\w+)$",version_and_date).group(1)
            record['content'] = list()
            features = re.escape(version_and_date) + r"([\s\S]*?)\n\n\n"

            features_in_str = re.findall(features,HTML)
            if len(features_in_str)==0:
                break;

            features_in_list = re.findall("\*\)\s*Feature:([\s\S]*?)\n\n",features_in_str[0])

            #make it one line for each feature
            for i in range(len(features_in_list)):
                features_in_list[i] = re.sub(r"\n\s+"," ",features_in_list[i])

            record['content'] = features_in_list

            parseResult.append(record)
        

        return getJSONStr(parseResult)

if __name__ == '__main__':
    testNginx = Nginx()
    testNginx.start()
    testNginx.join()
    print(testNginx)