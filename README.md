# Gioia Starter Plugin

Un semplice punto di partenza per lo sviluppo di plugin WordPress targati [Marcosh.net](https://www.marcosh.net/).

### Documentazione

Crea una copia di questa repository in locale:
```bash
$ cd desktop
$ git clone https://github.com/paolo-mnet/gioia-plugin-starter.git
$ cd gioia-plugin-starter
$ rm -rf .git
```

Apri la copia di questo progetto con il tuo IDE preferito (es. [Visual Studio Code](https://code.visualstudio.com/)), quindi cerca e sostituisci le ricorrenze di queste stringhe:

```
gwp -> il dominio del tuo plugin, in lowercase
GWP -> il dominio del tuo plugin, in uppercase
GWP_Starter -> il namespace del tuo plugin
Gioia Starter Plugin -> il nome per esteso del tuo plugin
```

Rinomina la cartella del plugin e il suo file principale con il nome del tuo plugin, in lowercase e separato da trattini.

Per il file, da terminale:
```
$ mv gioia-plugin-starter.php nome-mio-plugin.php
```

Buon lavoro! 💪
