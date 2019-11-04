#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *


class testSoftware(Parser):
    def parse(self):
        parseResult = []
        record1 = dict()
        record1['version'] = "1.0.0"
        record1['time'] = "2019-10-29"
        record1['content'] = ["11111",'22222','33333']

        record2 = dict()
        record2['version'] = "1.0.1"
        record2['time'] = "2019-11-02"
        record2['content'] = ["aaaa",'bbbbb','cccc']

        # Append update info to result list.

        parseResult.append(record1)
        # parseResult.append(record2)

        # 返回最终解析结果
        return (getJSONStr(parseResult))