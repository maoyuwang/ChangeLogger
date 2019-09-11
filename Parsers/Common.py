import json
import sys
from urllib import request
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
    try:
        result = request.urlopen(url,timeout=5).read().decode('utf-8')
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