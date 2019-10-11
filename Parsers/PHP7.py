#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *
import re

class php7(Parser):
    def parse(self):
        HTML = getWebsite("https://www.php.net/ChangeLog-7.php")
        soup = BeautifulSoup(HTML,"lxml")
        DIV = soup.find('div', attrs={"id": "layout"})
        content = DIV.find('section', attrs={"id": "layout-content"})
        anchor = content.find_all('section', attrs={"class": "version"})
        H3=list()
        UL=list()
        time=list()
        for x in anchor:
            H3=H3+x.find_all('h3')
            UL=UL+x.find_all('ul')
            time_tmp=x.find('time',attrs={"class":"releasedate"})
            time.append(time_tmp["datetime"])
        # 新建空列表准备储存解析结果
        parseResult = list()

        # 循环遍历所有的 h3 和 ul 标签
        # 第一个是简介，跳过
        for i in range(0, len(H3)):
            # 找到当前 ul 里面所有的 li 标签
            LI = UL[i].find_all("li")

            # 新建一个字典储存本次更新的详情
            record = dict()
            record['version'] = H3[i].text.split(" ")[-1]
            # 没有时间
            record['time'] = time[i]
            record['content'] = [li.text.replace("\n", "") for li in LI]

            # 将本次更新添加至最终解析结果中去
            parseResult.append(record)

        # 返回最终解析结果
        return (getJSONStr(parseResult))


if __name__ == '__main__':
    test = php7()
    test.start()
    test.join()
    print(test)









