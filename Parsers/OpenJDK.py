from Parsers.Parser import *
import re

class OpenJDK(Parser):
    def parse(self):
        HTML = getWebsite("https://adoptopenjdk.net/release_notes.html")
        soup = BeautifulSoup(HTML,"lxml")
        DIV = soup.find('div', attrs={"class": "align-left support"})

        anchor = DIV.find_all('div', attrs={"class": "anchor"})
        H2=list()
        for x in anchor:
            H2=H2+x.find_all('h2')

        Margins = DIV.find_all('div', attrs={"class": "margin-bottom"})
        UL=list()
        for x in Margins:
            UL=UL+x.find_all('ul')

        # 新建空列表准备储存解析结果
        parseResult = list()

        # 循环遍历所有的 h3 和 ul 标签
        # 第一个是简介，跳过
        for i in range(1, len(H2)):
            # 找到当前 ul 里面所有的 li 标签
            LI = UL[i].find_all("li")

            # 新建一个字典储存本次更新的详情
            record = dict()
            record['version'] = H2[i].text.replace("OpenJDK ", "").split(" ")[0]
            # 没有时间
            record['time'] = None
            record['content'] = [li.text.replace("\n", "") for li in LI]

            # 将本次更新添加至最终解析结果中去
            parseResult.append(record)

        # 返回最终解析结果
        return (getJSONStr(parseResult))


if __name__ == '__main__':
    test = OpenJDK()
    test.start()
    test.join()
    print(test)









