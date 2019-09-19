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
        for i in range(0,len(DIVs)):
            content = DIVs[i].div
            uls = content.ul
            if uls!=None:
                uls = content.find_all("ul")
                for ul in uls:
                    print(ul.text)
            else:
                print(content.text)
            # step2 = update_content.find_all("ul").find_all("li")
            # print(update_content)
            # print(DIVs[i].text)


if __name__ == '__main__':
    testiOS = iOS()
    testiOS.start()
    testiOS.join()
    print(getFormattedString(testiOS.getResult()))









