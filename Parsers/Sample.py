from Parsers.Parser import *
# 复制本示例来创建一个新的Parser
class Sample(Parser):
    def parse(self):
        # 解析页面的步骤写这里
        return getJSONStr([{'version':"0.0.1",'time':"2019-09-09",'content':["Create project Changelogger."]}])

if __name__ == '__main__':
    # 此处main方法用于测试
    testSample = Sample()
    testSample.start()
    testSample.join()
    print(testSample)
