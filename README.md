# Imagick svg bug
Imagick throws exception when trying to load svg `$imagick->readImageBlob($svgContent);` on some distro/packages configurations. Some configuration works with 
xml tag hack.

# Xml tag hack
Prepending `<?xml version="1.0" encoding="UTF-8" standalone="no"?>` to svg content in some configurations makes it work.

## System
Php 7.3 + imagick extension.

### Alpine
Official php alpine image. Works both original svg and with xml tag.

```shell
# build
docker build --file alpine.Dockerfile --tag test-generate-png-from-svg--alpine .
# run script
docker run -it --rm --volume "${PWD}/test-generate-png-from-svg.php:/test-generate-png-from-svg.php" test-generate-png-from-svg--alpine php /test-generate-png-from-svg.php
# php info
docker run --rm test-generate-png-from-svg--alpine php -i
```

### Debian
Official php image with debian. Works both original svg and with xml tag.

```shell
# build
docker build --file debian.Dockerfile --tag test-generate-png-from-svg--debian .
# run script
docker run -it --rm --volume "${PWD}/test-generate-png-from-svg.php:/test-generate-png-from-svg.php" test-generate-png-from-svg--debian php /test-generate-png-from-svg.php
# php info
docker run --rm test-generate-png-from-svg--debian php -i
```

### Ubuntu PPA
Ubuntu 18.04 image with php and imagick extension installed from ppa. None of the variants work.

```shell
# build
docker build --file ubuntu-ppa.Dockerfile --tag test-generate-png-from-svg--ubuntu-ppa .
# run script
docker run -it --rm --volume "${PWD}/test-generate-png-from-svg.php:/test-generate-png-from-svg.php" test-generate-png-from-svg--ubuntu-ppa php /test-generate-png-from-svg.php
# php info
docker run --rm test-generate-png-from-svg--ubuntu-ppa php -i
```

### Ubuntu manual
Ubuntu 18.04 with php from installed from ppa and extension install with pecl. Only variant with xml tag works.

```shell
# build
docker build --file ubuntu-manual.Dockerfile --tag test-generate-png-from-svg--ubuntu-manual .
# run script
docker run -it --rm --volume "${PWD}/test-generate-png-from-svg.php:/test-generate-png-from-svg.php" test-generate-png-from-svg--ubuntu-manual php /test-generate-png-from-svg.php
# php info
docker run --rm test-generate-png-from-svg--ubuntu-manual php -i
```
