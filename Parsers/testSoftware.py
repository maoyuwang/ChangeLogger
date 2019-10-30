#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *


class testSoftware(Parser):
    def parse(self):
        parseResult = []
        record = dict()
        record['version'] = "1.0.0"
        record['time'] = "2019-10-29"
        record['content'] = ["11111",'22222','33333']

        # 将本次更新添加至最终解析结果中去
        parseResult.append(record)

        # 返回最终解析结果
        return (getJSONStr(parseResult))