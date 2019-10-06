#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *


class TelegramMac(Parser):
    def parse(self):
        # 获取网页源代码
        HTML = getWebsite("https://macos.telegram.org/")

        # 生成 soup 对象
        soup = BeautifulSoup(HTML, "lxml")

        # 找到 ID 为 dev_page_content 的 div 区域
        DIV = soup.find('div', attrs={"id": "dev_page_content"})

        # 找到所有的 h3 标签 和 ul 标签
        H3 = DIV.find_all('h3')
        UL = DIV.find_all('ul')

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
    # 新建 Telegram 解析器
    testTelegramMac = TelegramMac()

    # 运行解析器进程
    testTelegramMac.start()

    # 等待进程运行结束
    testTelegramMac.join()

    # 打印解析结果
    print(getFormattedString(testTelegramMac.getResult()))
