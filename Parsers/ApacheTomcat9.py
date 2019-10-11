#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *
import re

class ApacheTomcat(Parser):
    def parse(self):
        HTML = getWebsite("http://tomcat.apache.org/tomcat-9.0-doc/changelog.html")
        soup = BeautifulSoup(HTML,"lxml")
        DIV = soup.find('div', attrs={"id": "middle"}).find('div', attrs={"id": "mainRight"})
        content = DIV.find('div', attrs={"id": "content"})
        H3=content.find_all('h3')
        UL = content.find_all('div', attrs={"class": "text"})
        time=content.find_all('span', attrs={"style": "float: right;"})
        # 新建空列表准备储存解析结果
        parseResult = list()

        # 循环遍历所有的 h3 和 ul 标签
        # 第一个是简介，跳过
        for i in range(0, len(H3)):
            # 找到当前 ul 里面所有的 li 标签
            LI = UL[i].find_all("li")
            #print(LI)
            # 新建一个字典储存本次更新的详情
            record = dict()
            record['version'] = H3[i].text
            # 没有时间
            if(i==0):
                record['time'] = "None"
            else:
                record['time'] = time[i-1].text
            record['content'] = [li.text.replace("\n", "").replace("       ","") for li in LI]

            # 将本次更新添加至最终解析结果中去
            parseResult.append(record)

        # 返回最终解析结果
        return (getJSONStr(parseResult))


if __name__ == '__main__':
    test = ApacheTomcat()
    test.start()
    test.join()
    print(test)









