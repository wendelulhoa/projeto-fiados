import pyautogui as py
import sys

x = int(sys.argv[1])
y = int(sys.argv[2])

py.moveTo(1, 1)
py.moveTo(x, y, duration = 2)
py.click()