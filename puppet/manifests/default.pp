class packages {
  exec { "apt-get update":
    command => "/usr/bin/apt-get update"
  }

  $packages = [
    'apache2',
    'php5',
    'php-pear',
    'mysql-server',
    'php5-mysql',
    'php5-suhosin',
    'libapache2-mod-php5',
    'libapache2-mod-auth-mysql'
  ]

  package { $packages:
    ensure => present,
    require => Exec["apt-get update"]
  }
}

include packages
