from Parsers.Parser import *
class VisualStudioCode(Parser):
    def parse(self):

    	#get the website's source code
        HTML = getWebsite("https://code.visualstudio.com/updates")

        #put the source code into soup object
        Updates = BeautifulSoup(HTML, "lxml")

        NAV = Updates.find('nav', attrs={"id": "docs-navbar"})

        parseResult = list()

        #find links to all versions in the navigating bar
        versions = NAV.find_all('li')
        for version in versions:
        	link = version.find('a')
        	version_link = "https://code.visualstudio.com"+link['href']
        	updates_page = getWebsite(version_link)
        	#get the soup object for the current version
        	current_update = BeautifulSoup(updates_page, "lxml")

        	version_contents = current_update.find('div', attrs={"class": "col-sm-9 col-md-8 body"})

        	version_and_date = version_contents.find('h1').text

        	record = dict()
        	record['version'] = version_and_date[version_and_date.rfind(' ')+1:-1]
        	record['time'] = version_and_date[:version_and_date.find('(')-1]
        	record['content'] = list()

        	#find the first <ul>, which contains brief information about updates
        	features = version_contents.find('ul').find_all('li')

        	has_features = True
        	check = features[0].find_all(text=True)
        	if len(check) != 2:
        		has_features = False

        	#find the features
        	for i in features:
        		if has_features == False:
        			break
        		
        		feature = i.find_all(text=True)
        		single_feature = ""
        		for txt in feature:
        			single_feature += txt
        		record['content'].append(single_feature)

        	parseResult.append(record)

        return getJSONStr(parseResult)

if __name__ == '__main__':
    testVisualStudioCode = VisualStudioCode()
    testVisualStudioCode.start()
    testVisualStudioCode.join()
    print(testVisualStudioCode)