from Parsers.Parser import *

class TelegramDesktop(Parser):
    def parse(self):
        HTML = getWebsite("https://desktop.telegram.org/changelog")
        soup = BeautifulSoup(HTML,"lxml")
        DIV = soup.find('div', attrs={"id": "dev_page_content"})
        H3 = DIV.find_all("h3")
        UL = DIV.find_all("ul")

        # 新建空列表准备储存解析结果
        parseResult = list()

        # 循环遍历所有的 h3 和 ul 标签
        for i in range(0, len(H3)):
            # 找到当前 ul 里面所有的 li 标签
            LI = UL[i].find_all("li")

            # 新建一个字典储存本次更新的详情
            record = dict()
            record['version'] = H3[i].text.replace("v ", "").split(" ")[0]
            record['time'] = H3[i].text.replace("v ", "").split(" ")[1]
            record['content'] = [li.text.replace("\n", "") for li in LI]

            # 将本次更新添加至最终解析结果中去
            parseResult.append(record)

        # 返回最终解析结果
        return (getJSONStr(parseResult))



if __name__ == '__main__':
    # 此处main方法用于测试
    testTelegramDesktop = TelegramDesktop()
    testTelegramDesktop.start()
    testTelegramDesktop.join()
    print(testTelegramDesktop)
