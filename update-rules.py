#!/usr/bin/env python2.7

from Cheetah.Template import Template
import subprocess

templateFile = open("/vagrant/rules.v4.tmpl")
templateDef = templateFile.read()
ips = subprocess.check_output(["dig", "+short", "smtp.mailtrap.io"]).split("\n")[:-1]
print(ips)
nameSpace = {'ips':ips}
t = Template(templateDef, searchList=[nameSpace])

rules = open("/vagrant/rules.v4","w")
rules.write(str(t))

templateFile.close()
rules.close()
