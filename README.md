# MessageBird assignment

## Installation

1. Clone the repository:
```
git clone https://github.com/dimichspb/messagebird
```

2. Install dependencies:
```
composer update
```

## Configuration

1. Create local configuration file:
```
/config-local.ini
```

2. Specify MessageBird API Access key in local configuration file:
```
[messagebird]
access_key=YOUR_TOP_SECRET_ACCESS_KEY
```

Main configuration file:
```
/config.ini
```

Local configuration file:
```
/config-local.ini
```


## Usage

1. From the web:

```
web/index.php
```

Welcome page:
```
/
```

Message endpoint (POST)
```
/message
```

2. From the console:

```
console
```

Default command:
```
console 
```

Queue command:
```
console queue
```

