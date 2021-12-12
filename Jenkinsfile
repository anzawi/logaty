pipeline {
  agent any
  stages {
    stage('Checkout') {
      steps {
        git(url: 'https://github.com/anzawi/logaty.git', branch: 'master')
      }
    }

    stage('Test') {
      parallel {
        stage('PHP 8.1.0') {
          agent {
            docker {
              image 'php:8.1.0-fpm'
              args '-u root:sudo'
            }

          }
          steps {
            echo 'Running PHP 8.1.0 tests...'
            sh 'php -v'
            echo 'Installing Composer'
            sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer'
            echo 'installing zip ext'
            sh 'apt-get update && apt-get install -y unzip git rsync zip libzip-dev'
            sh 'docker-php-ext-install zip'
            sh 'docker-php-ext-enable zip'
            echo 'Installing project composer dependencies...'
            sh 'cd $WORKSPACE && composer install --no-progress'            
            echo 'Running PHPUnit tests...'
            sh 'php $WORKSPACE/vendor/bin/phpunit --coverage-html $WORKSPACE/report/clover --coverage-clover $WORKSPACE/report/clover.xml --log-junit $WORKSPACE/report/junit.xml'
            sh 'chmod -R a+w $PWD && chmod -R a+w $WORKSPACE'
            junit 'report/*.xml'
          }
        }

        stage('PHP 7.4') {
          agent {
            docker {
              image 'php:7.4-fpm'
              args '-u root:sudo'
            }

          }
          steps {
            echo 'Running PHP 7.4 tests...'
            sh 'php -v'
            echo 'Installing Composer'
            sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer'
            echo 'installing zip ext'
            sh 'apt-get update && apt-get install -y unzip git rsync zip libzip-dev'
            sh 'docker-php-ext-install zip'
            sh 'docker-php-ext-enable zip'
            echo 'Installing project composer dependencies...'
            sh 'cd $WORKSPACE && composer install --no-progress'
            echo 'Running PHPUnit tests...'
            sh 'php $WORKSPACE/vendor/bin/phpunit --coverage-html $WORKSPACE/report/clover --coverage-clover $WORKSPACE/report/clover.xml --log-junit $WORKSPACE/report/junit.xml'
            sh 'chmod -R a+w $PWD && chmod -R a+w $WORKSPACE'
            junit 'report/*.xml'
          }
        }
      }
    }

    stage('Release') {
      steps {
        echo 'Ready to release etc.'
      }
    }

  }
}
