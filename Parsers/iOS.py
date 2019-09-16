from Parsers.Parser import *
import re

class iOS(Parser):
    def parse(self):
        HTML = getWebsite("https://support.apple.com/en-us/HT209084")
        soup = BeautifulSoup(HTML, "lxml")

        DIV = soup.find('div',attrs={"id":"sections"})

        parseResult = list()

        versions = DIV.find_all('h2')
        print(versions)

        DIVs = DIV.find_all("div", {"id": re.compile("^\d{1,}$")})
        print(DIVs[4].text)


if __name__ == '__main__':
    testiOS = iOS()
    testiOS.start()
    testiOS.join()
    print(getFormattedString(testiOS.getResult()))









