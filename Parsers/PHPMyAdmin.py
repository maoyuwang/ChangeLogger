from Parsers.Parser import *
import re

#This parser only grabs information after version 2.11.10.1
class PhpMyAdmin(Parser):
	def parse(self):

		# get the website's source code
		HTML = getWebsite("https://www.phpmyadmin.net/files/")

		# put the source code into soup object
		Updates = BeautifulSoup(HTML, "lxml")
		
		NAV = Updates.find('tbody')

		parseResult = list()

		# find links to all versions in the navigating bar
		versions = NAV.find_all('th')

		for version in versions:
			version_link = "https://www.phpmyadmin.net/files/" + version.text + "/"
			updates_page = getWebsite(version_link)
			# get the soup object for the current version
			current_update = BeautifulSoup(updates_page, "lxml")

			version_contents = current_update.find('pre')
			if version_contents == None : continue
			version_contents = version_contents.text

			record = dict()
			record['version'] = version.text
			record['time'] = re.search("Released (\d+-\d+-\d+)\.",updates_page).group(1)
			record['content'] = list()

			if record['version'] >= "2.11.10.1":
				features = re.findall("\* ([\s\S]*?)(?=\s+\*|\n\n)",version_contents)
				bugs = re.findall("- ([\s\S]*?)(?=\s+-|\n\n)",version_contents)
				#make it one line for each feature or bug
				for i in range(len(features)):
					features[i] = re.sub(r"\n\s*"," ",features[i])
				for i in range(len(bugs)):
					bugs[i] = re.sub(r"\n\s*"," ",bugs[i])
				
				record['content'] = features + bugs

				if len(record['content']) == 0 : continue

			parseResult.append(record)


		return getJSONStr(parseResult)
		


if __name__ == '__main__':
	testPhpMyAdmin = PhpMyAdmin()
	testPhpMyAdmin.start()
	testPhpMyAdmin.join()
	print(testPhpMyAdmin)
