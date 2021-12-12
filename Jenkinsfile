pipeline {
  agent any
  stages {
    stage('install dependencies') {
      steps {
        sh 'composer install'
        sh 'vendor/bin/phpunit'
      }
    }

  }
}