FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
      wget \
      git \
      fish \
      unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

ARG USER_ID
ARG GROUP_ID

RUN groupadd -f --gid $GROUP_ID user
RUN adduser --disabled-password --gecos '' --uid $USER_ID --gid $GROUP_ID user
USER user

WORKDIR /usr/src/

COPY ./ /usr/src/