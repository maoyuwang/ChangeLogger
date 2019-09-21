from Parsers.Parser import *
import re

class Curl(Parser):
    def parse(self):
        HTML = getWebsite("https://curl.haxx.se/changes.html")
        soup = BeautifulSoup(HTML,"lxml")
        DIV = soup.find('div', attrs={"class": "contents"})
        H3 = DIV.find_all("h2")
        UL= DIV.find_all("ul")
        # 新建空列表准备储存解析结果
        parseResult = list()

        # 循环遍历所有的 h3 和 ul 标签
        for i in range(0, len(H3)):
            # 找到当前 ul 里面所有的 li 标签
            LI = UL[i].find_all("li")

            # 新建一个字典储存本次更新的详情
            record = dict()

            record['version'] = H3[i].text.replace("Fixed in ", "").split(" ")[0]
            record['time'] = H3[i].text.replace("Fixed in ", "").split(" ")[1]
            record['content'] = [li.text.replace("\n", "") for li in LI]

            # 将本次更新添加至最终解析结果中去
            parseResult.append(record)

        # 返回最终解析结果
        return (getJSONStr(parseResult))


if __name__ == '__main__':
    test = Curl()
    test.start()
    test.join()
    print(test)









