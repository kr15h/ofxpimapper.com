---
title: "GitHub Instructions"
---

Get image for latest [Raspbian Jessie](http://downloads.raspberrypi.org/raspbian/images/raspbian-2017-07-05/) and download [Etcher](https://etcher.io/) to burn it onto your SD card. Chose a Class 10 SD card, such as SanDisk Ultra 8GB Class 10 microSD card.

Get your Raspberry Pi, all versions of it should work. Most of the time ofxPiMapper is used with [Raspberry Pi 3 model B](https://www.raspberrypi.org/products/raspberry-pi-3-model-b/). Insert the SD card into the SD card slot, connect keyboard, mouse, display and a network cable if you do not have a working WiFi network around.

Connect your Pi to a power source and wait for it to boot up. It will restart once during the first boot due to file system expansion which happens automatically.

From here on you should use your keyboard that is connected to the Raspberry Pi.

Download stable version of openFrameworks, which at the time of writing this is version 0.9.8.

```
cd
wget http://openframeworks.cc/versions/v0.9.8/of_v0.9.8_linuxarmv6l_release.tar.gz
mkdir openFrameworks
tar vxfz of_v0.9.8_linuxarmv6l_release.tar.gz -C openFrameworks --strip-components 1
```

Next, you have to install dependencies. Use the commands below. At some points of the installation the system will ask you whether you are sure that you want to install something. Hit `y` and `Enter` to proceed.

```
cd /home/pi/openFrameworks/scripts/linux/debian
sudo ./install_dependencies.sh
```

Now you have all the components ready to be able to compile openFrameworks. Do that by using the following command.

```
make Release -C /home/pi/openFrameworks/libs/openFrameworksCompiled/project
```

Install git in order to be able to download addons from GitHub.

```
sudo apt-get install git
```

Go to openFrameworks addons folder and download ofxPiMapper and the ofxOMXPlayer dependency.

```
cd /home/pi/openFrameworks/addons
git clone https://github.com/kr15h/ofxPiMapper.git
git clone https://github.com/jvcleave/ofxOMXPlayer.git
```

Checkout the stable version of ofxOMXPlayer.

```
cd /home/pi/openFrameworks/addons/ofxOMXPlayer
git checkout 0.9.0-compatible
```

Go to the ofxPiMapper example folder and compile it.

```
cd /home/pi/openFrameworks/addons/ofxPiMapper/example
make
```

When compiling is done, launch the example (use the -f flag to launch it fullscreen) and have fun! 

```
cd bin
./example -f
```

Don't forget to check out the shortcuts on the [GitHub repository](https://github.com/kr15h/ofxPiMapper#other-shortcuts). Check out the `example_pocketvj` if you want to make a version with your own shortcuts.

