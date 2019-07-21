---
title: "Image Instructions"
---

On this page you will find steps to follow to get your Pi Mapper disk image working on your Raspberry Pi. Currently Raspberry Pi 4 is not yet supported due missing dependencies for the Raspbian Buster system.

Choose your topic.

- [Preparing the SD Card](#preparing-the-sd-card)
- [Using Own Sources](#using-own-sources)
- [Encoding Sources](#encoding-sources)
- [Deleting Sources](#deleting-sources)

## Preparing the SD Card

First of all, download [Balena Etcher](https://www.balena.io/etcher/). If you use Etcher, you don't need to unzip the file you downloaded.

Open Etcher and select image file. 

Put your SD card into the SD card reader slot of your personal computer. Anything 16 GB Class 10 is a fine choice.

In Etcher, select the SD card device you put your SD card into.

You can disable the verification step in the Settings to make things go faster. Press Flash and wait.

When flashing is done, plug the SD card into the Raspberry Pi. Do not power the Pi up yet. Connect keyboard, mouse and display before attaching the power source. Make sure the display is on and set to get video input from the Raspbery Pi.

Connect your Pi to a power source. The boot process should look similar to the one of a regular Raspbian, but at the ent it should start Pi Mapper. Use your keyboard and mouse to click, select and transform surfaces.

Take a look at the [keyboard shortcuts](https://github.com/kr15h/ofxPiMapper#other-shortcuts) to access full functionality! 

## Using Own Sources

You can upload your own sources using a USB flash memory stick. Copy your video and image files to the root of the USB flash drive. Insert the memory stick into the Raspberry Pi and quit Mapper by hitting the **ESC** key. Mapper will start automatically in 30 seconds and your sources will be available for mapping. 

List of supported image and video formats.

| Image | Video |
| ---   | ---   |
| jpg   | mp4   |
| jpeg  | mov   |
| png   | mkv   |

## Encoding Sources

Easiest way to achieve success is to use [HandBrake](https://handbrake.fr) with the following settings. This will produce a **.mkv** file with **16bit FLAC** audio with **22.05KHz** sampling rate.

```
Preset: Fast 720p30
Summary / Format: MKV File
Video / Framerate: Same as source
Video / Profile: Baseline
Audio / Codec: FLAC 16-bit
Audio / Samplerate: 22.05
```

If you are familiar with [ffmpeg](https://ffmpeg.org/), use the following. It will produce a **.mov** file. **PCM audio** codec with **22KHz** sampling rate.

```
ffmpeg -i input-video.mp4 -s 1280x720 -aspect 16:9 \
  -c:v libx264 -profile:v baseline \
  -c:a pcm_s16le -ar 22000 -ac 2 \
  output-video.mov
```

## Deleting Sources

**Available from v1.1.0**

You can delete all, except default, sources by placing an empty file with the name **PIMAPPER_DELETE_SOURCES** in the root level of your USB memory stick. After deletion Pi Mapper will attempt to copy any of the video and image sources that can be found on the USB stick, so make sure that you remove the files you want to delete from the memory stick first.


