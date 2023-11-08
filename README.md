# DATA.DB.200 Tietokantajärjestelmät SQL

Trash repository for getting files to the server.

## Palvelimeen yhdistäminen

```bash
ssh nxanph@linux-ssh.tuni.fi
ssh tie-tkannat.it.tuni.fi
```

## SSH-tunnelin luominen

```bash
ssh -f nxanph@linux-ssh.tuni.fi -L 7777:tie-tkannat.it.tuni.fi:80 -N
ssh -L 7777:tie-tkannat.it.tuni.fi:80 nxanph@linux-ssh.tuni.fi
```

URL: <http://localhost:7777/nxanph/testi2.php>
