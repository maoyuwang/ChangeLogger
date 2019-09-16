from Parsers.Parser import *


class iOS(Parser):
    @property
    def parse(self):
        HTML = getWebsite("https://support.apple.com/en-us/HT209084")

        soup = BeautifulSoup(HTML, "lxml")

        DIV = soup.find('div ', attrs={"class": ""})

        parseResult = list()

        versions = DIV.find('h2')

        P = DIV.find_all('p')
        UL = DIV.fina_all('ul')
        parseResult = list()
        for i in range(0, len(versions)):
            LI = UL[i]. find_all("li")
            record = dict()
            record['version'] = versions[i].text

            parseResult.append(record)
        return(getJSONStr(parseResult))



if __name__ == '__main__':
    testiOS = iOS()
    testiOS.start()
    testiOS.join()
    print(getFormattedString(testiOS.getResult()))









