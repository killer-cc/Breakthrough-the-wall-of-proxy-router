#!/usr/bin/python3

import urllib.request , json , time , os

def getNewData():
    #get data from database
    url = "http://localhost/api.php?action=getDatas"
    data = urllib.request.urlopen(url)
    data = json.loads(data.read())

    #process data
    if data["domain"] != None:
        domain = []
        for i in data["domain"]:
            domain += [i["domain"]]
    else:
        domain = ["example.com"]

    if data["ip"] != None:
        ip = []
        for i in data["ip"]:
           ip += [i["ip"]]
    else:
        ip = ["188.166.188.226"]

    return domain,ip

def update_config(domain,ip):
    #read config file
    v2ray_config = open("/usr/local/etc/v2ray/config.json.default","r")
    v2ray_data = json.load(v2ray_config)
    v2ray_config.close()

    v2ray_data["routing"]["rules"][0]["domain"] = domain
    v2ray_data["routing"]["rules"][1]["ip"] = ip

    v2ray_data = json.dumps(v2ray_data,indent=2)

    #write config file
    v2ray_config = open("/usr/local/etc/v2ray/config.json","w")
    print(v2ray_data,file=v2ray_config)
    v2ray_config.close()
    os.system("sudo service v2ray restart")

def main():
    domain,ip = ["example.com"],["188.166.188.226"]
    update_config(domain,ip)
    update = False
    while True:
        new_domain, new_ip = getNewData()
        if new_domain != domain:
            domain = new_domain
            update = True
        if new_ip != ip:
            ip = new_ip
            update = True
        if update:
            update_config(domain,ip)
            update = False
        time.sleep(1)
main()
