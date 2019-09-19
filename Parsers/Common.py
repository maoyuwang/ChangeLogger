import json
import sys
from urllib import request
import urllib
import ssl
from bs4 import BeautifulSoup


def getJSONStr(obj):
    """
    Convert a hashable object to a JSON String.
    :param d: A hashable object.
    :return: return the string in JSON format of the object.
    """
    try:
        str = json.dumps(obj)
    except:
        str = None
        print("ERROR: Given parameter is not a dictionary!", file=sys.stderr)
    return str

def getWebsite(url):
    """
    Get and return the raw HTML source code of given web page.
    :param url: The url to visit and get source code.
    :return:    The string of raw HTML source code for given web page.
    """
    ssl._create_default_https_context = ssl._create_unverified_context
    try:
        req = urllib.request.Request(
            url,
            data=None,
            headers={
                'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.47 Safari/537.36'
            }
        )

        reqResult = request.urlopen(req,timeout=5)
        result = reqResult.read().decode('utf-8')
    except:
        result = None
        print("ERROR: Failed to visit '{}'!".format(url), file=sys.stderr)
    return result

def getFormattedString(s):
    """
    Return a beautiful formatted string of changelogs for printing.
    :param s:   The changelogs string.
    :return:    Formatted string.
    """
    if s == None:
        return None
    string = ""
    for item in json.loads(s):
        string += item['version']
        string += " ({})\n".format(item['time'])
        for feature in item['content']:
            string += "\t- {}\n".format(feature)
    return string