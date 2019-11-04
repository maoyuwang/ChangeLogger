from Parsers import *
from dataFilter import *
import hashlib
from NotificationFactory import NotificationFactory


def getMD5(string):
    """
    Generate the md5 of the string
    :param string: The string to deal with.
    :return: The md5 value of the string.
    """
    m = hashlib.md5()
    m.update(string.encode('UTF-8'))
    md5Str = m.hexdigest()
    return md5Str

def idLabler(changelogs):
    """
    Add an 'id' tag which is the md5 value for each piece of changelog.
    :param changelogs: The list of changelogs for a single software.
    :return: The list of changelogs which is labeled by md5.
    """
    result = changelogs
    for changelog in result:
        verison = changelog['version']
        time = changelog['time']
        content = json.dumps(changelog['content'])

        changelog["id"] = getMD5(verison + time + content)
    return result

if __name__ == '__main__':

    # Create a database object.
    db = DB()

    # Create a factory for producing different kinds of notifications.
    nofiticationFactory = NotificationFactory()

    # Creata a list of parsers to track updates.
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
            (12,Rust.Rust()),
            (99,testSoftware.testSoftware())
        ]

    resultList = [None] * len(parserList)

    # Start all parser threads.
    for (softwareID,parser) in parserList:
        parser.start()
    # Deal with parse results.
    for index in range(0,len(parserList)):
        (softwareID,parser) = parserList[index]
        parser.join()

        # Convert to json format.
        resultList[index] = json.loads(parser.getResult())

        # Label each piece of changelog with md5
        resultList[index] = idLabler(resultList[index])

        # Create a data filter and filter the latest unknown changelogs.
        mydataFilter = dataFilter(softwareID)
        filterResult = mydataFilter.filter(resultList[index])

        # Add filtered results to database.
        db.addChangelogs(softwareID,filterResult)

        # Notify users who care about it.
        nofiticationFactory.add(softwareID,filterResult)





