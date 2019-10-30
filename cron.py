from Parsers import *
from dataFilter import *
import hashlib
from NotificationFactory import NotificationFactory

def getMD5(string):
    m = hashlib.md5()
    m.update(string.encode('UTF-8'))
    md5Str = m.hexdigest()
    return md5Str

def idLabler(changelogs):
    result = changelogs
    for changelog in result:
        verison = changelog['version']
        time = changelog['time']
        content = json.dumps(changelog['content'])

        changelog["id"] = getMD5(verison + time + content)
    return result

if __name__ == '__main__':

    db = DB()
    nofiticationFactory = NotificationFactory()

    parserList = \
        [
            (3,Curl.Curl()),
            (4,Nginx.Nginx()),
            (5,OpenJDK.OpenJDK()),
            (2,TelegramDesktop.TelegramDesktop()),
            (1,TelegramMac.TelegramMac()),
            (6,VisualStudioCode.VisualStudioCode()),
            (7,ApacheTomcat9.ApacheTomcat()),
            (8,HAProxy.HAProxy()),
            (9,Nodejs10.NodeJS10()),
            (10,PHP7.php7()),
            (11,Redis.Redis()),
            (12,Rust.Rust())
        ]

    resultList = [None] * len(parserList)

    for (softwareID,parser) in parserList:
        parser.start()

    for index in range(0,len(parserList)):
        (softwareID,parser) = parserList[index]
        parser.join()
        resultList[index] = json.loads(parser.getResult())
        resultList[index] = idLabler(resultList[index])
        mydataFilter = dataFilter(softwareID)
        filterResult = mydataFilter.filter(resultList[index])
        db.addChangelogs(softwareID,filterResult)
        nofiticationFactory.add(softwareID,filterResult)





