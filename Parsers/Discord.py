from Parsers.Parser import *
class Discord(Parser):
    def parse(self):

        HTML = getWebsite("https://blog.discordapp.com/tagged/changelog")

        return getJSONStr([{'version':"0.0.1",'time':"2019-09-09",'content':["Create project Changelogger."]}])

if __name__ == '__main__':
    testDiscord = Discord()
    testDiscord.start()
    testDiscord.join()
    print(testDiscord)