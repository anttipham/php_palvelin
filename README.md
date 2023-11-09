# DATA.DB.200 Tietokantajärjestelmät SQL

Trash repository for getting files to the server.

## Palvelimeen yhdistäminen

```bash
ssh nxanph@linux-ssh.tuni.fi
ssh tie-tkannat.it.tuni.fi
```

## PostgreSQL

```bash
psql nxanph
ezd6XpnRIzkK9nq
```

## SSH-tunnelin luominen

```bash
ssh -f nxanph@linux-ssh.tuni.fi -L 7777:tie-tkannat.it.tuni.fi:80 -N
ssh -f nxanph@linux-ssh.tuni.fi -L 7777:tie-tkannat.it.tuni.fi:443 -N
ssh  -L 7777:tie-tkannat.it.tuni.fi:80 nxanph@linux-ssh.tuni.fi -f -N
ssh  -L 7777:tie-tkannat.it.tuni.fi:443 nxanph@linux-ssh.tuni.fi -f -N
```

URL: <https://tie-tkannat.it.tuni.fi/~nxanph/testi1.php>
URL: <https://localhost:7777/~nxanph/testi1.php>
