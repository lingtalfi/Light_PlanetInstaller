Light_PlanetInstaller, conception notes
================
2020-12-03 -> 2020-12-21

This is a simpler version of the [uni tool](https://github.com/lingtalfi/universe-naive-importer), which I found too
complicated.

What's different from the **uni** tool is that:

- it supports dependency resolution WITH RESPECT to version numbers
- it can install (installable) plugins in addition to importing it in your app
- it has a lpi.byml file, which you can use as an interface to express your installation wishes (very much like the **
  package.json** used by npm)

The lpi.byml file
-------------
2020-12-03

The **lpi.byml** file is the [babyYaml](https://github.com/lingtalfi/BabyYaml) file where you say which planets (and
optionally which version) you want.

It looks something like this:

```yaml
planets:
    -   Ling.AdminTable: 1.6.6
    -   Ling.AjaxCommunicationProtocol: 1.1.0
    -   Ling.ArrayDiff: 1.0.0
    -   Ling.ArrayToString: 1.4.0
```

The idea is that once you've created this file, you call the **install** method (or import if you prefer to just import)
without arguments, and it will make sure that all the planets defined in the **lpi.byml** file are installed (or
imported) in your current app.

When you call the **install** (or import) method with a planetId argument, it will install/update the planet, and update
the **lpi.byml** file.

### The content of the lpi.byml

2020-12-03 -> 2020-12-04

This is a [babyYaml](https://github.com/lingtalfi/BabyYaml) file, and the content looks like this:

```yaml

planets:
    $galaxy.$planet: $versionExpression(:$handlerString)?

```

With:

- $galaxy: the name of the galaxy
- $planet: the name of the planet
- $versionExpression: the [version expression](#version-expression) representing the desired version for this planet.

Example:

```yaml
planets:
    Ling.PlanetTest: 1.5.2
    John.DooLittle: 1.0.0
    Berthold.Tomahawk: 1.4.4+
    Machine.Gun: lastlocal
    Horten.Sia: last
```                

The handlers
------------
2020-12-03 -> 2020-12-07

What we call **handler** is the technique used to fetch a planet.

A planet could be hosted on **github.com** for instance, or **bitbucket.org**, or on a personal server, or on
**packagist.org**, etc...

Each site requires a dedicated handler.

Each handler might require some parameter to work properly.

The **galaxy** is just an alias for a particular handler along with a specific set of parameters. By default, you cannot
have different handlers for a given galaxy. So for instance the **Ling** galaxy means two things:

- packages from author Ling
- packages hosted on github.com

This plugin doesn't handle exception to this rule. If you are an author which hosts your plugins in different hosts, but
with the same galaxy name, then you need another, more agnostic, installer to do so.

This means our philosophy would be to have galaxy names like this:

- LingGithub
- LingBitBucket
- LingPackagist
- LingHostXXX
- ...

Of course, you can be more creative than that and find more poetic names, but in essence that's the idea with this
installer.

A handler is defined by the following properties:

- type: the type of handler, which corresponds to a class in our plugin. So far, the available handlers are:
    - **github**: a handler that fetches planet from **github.com**


- ...other properties, depending on the type. For type=github, the properties are:
    - account: the name of the github account, it is such as the url corresponding to the github repository url is:
    - **https://github.com/$account/$planet**. This handler expects that the different versions of your planet are
      released as tags on github.com, so that the url to access that $version is:
    - https://github.com/$account/$planet/releases/tag/$version

Handlers are defined in the [global configuration](#the-global-configuration), under the **handlers** property.



The difference between install and import
-----------
2020-12-03

Import is basically taking a folder and moving it somewhere.

Install does the same thing as import, but it does the extra step of installing the plugin, if the plugin is
installable.

A plugin is considered installable if any of the following conditions is met:

- it's registered to the [plugin_installer service](https://github.com/lingtalfi/Light_PluginInstaller)

The global directory
-------------
2020-12-03

The global directory is a way to share your universe library across multiple applications. It's also a way to provide
access to your plugins directly from the filesystem, rather than having to fetch them via the web (i.e. slow).

In other words, it's some kind of cache for the planets.

The global directory is by default placed in here:

- /usr/local/share/universe/Ling/Light_PlanetInstaller/planets

To change the default location, change the value of the **global_dir_path** property in
the [global configuration](#the-global-configuration).

When fetching plugins, the Light_PlanetInstaller will first look in your global directory for a plugin with the exact
same version number. If found, it will fetch the plugin files from there. If not found, it will try to find it on the
web.



### Filesystem structure

2020-12-03 -> 2020-12-20

The **global directory** contains one directory per version of a planet. It's structure looks like this:

```txt
- $global_dir/
----- $galaxy/
--------- $planet/
------------- $version/ 
```



Tip: to create the global directory "rapidly", first download the parts of the universe you want locally,
from locations such as [karayabin repository](https://github.com/karayabin/universe-snapshot#the-planet-identifier), then put that in a script and execute:


```php 
$uniDir = "/myphp/universe";
LpiHelper::createGlobalDirByUniverseDir($uniDir, true);
a("ok");
```




The global configuration
----------
2020-12-03 -> 2020-12-10

The configuration of this service is stored in a global location:

- /usr/local/share/universe/Ling/Light_PlanetInstaller/conf.byml
This location can't be changed.



It contains the following properties:

```yaml

# The global directory (see the "global directory" section for more details)
global_dir_path: usr/local/share/universe/Ling/Light_PlanetInstaller/planets


# location of the local master file
master_path: usr/local/share/universe/Ling/Light_PlanetInstaller/lpi-master.byml

# location of the local master version file 
master_version_path: usr/local/share/universe/Ling/Light_PlanetInstaller/lpi-master-version.txt

# the upgrade moe
upgrade_mode: auto


# An array of galaxyName => default handler parameters
handlers:
    Ling:
        type: github
        account: lingtalfi

```

Those are the default values, which are implicit. Which means if you don't create the configuration file at all, those
values will still be used.

Of course, you can overwrite them by creating the configuration file.




The logging system
----------
2020-12-04 -> 2020-12-07

When you execute a command, a number of things can go wrong. For instance if you import a planet and the version you ask
for doesn't exist, etc...

All those errors are being logged, using the [Light_Logger](https://github.com/lingtalfi/Light_Logger) plugin under the
hood (if available), with a channel of **lpi_error**.







Version expression
---------
2020-12-03 -> 2020-12-21

The **version expression** represents the number of the desired version.

It must be one of the following formats:

- $major.$minor.$patch
- $major.$minor

Note: other formats could be added in the future.

In addition to those formats, here are some special notations that we can use:

- **last**: we can use the special "last" keyword to indicate that we always want the current version from the web, which supposedly is the last one.
  Note: I'm aware that your local machine might have a latter version (in case you're the plugin author), but I wanted to keep things simple,
  basically saying: the lpi tool only works with published plugins.
  
- The plus symbol (+): add this immediately (no space in between) after the version number to indicate that you want the
  planet with specified number or higher.

Note: it's actually recommended to use **lastlocal** vs **last**, because **lastlocal** is much faster. However, before
using the **lastlocal** keyword, make sure that all the planets you want are in
your [global directory](#the-global-directory).

Since the **global directory** has a peculiar file structure, you can use the **convert** command to copy your planets
to the **global directory** (instead of doing the conversion manually).

Note: if you're not the author of the planets you want to use, usually planet authors create a zip containing all the
planets of their galaxy(ies). Find that zip, download it and use the **convert** command on it, that would be faster
than using the **last** keyword.


Usage: the commands
-----------
2020-12-03 -> 2020-12-10

Before you can use any of those commands, you need to be at the root directory of your app (i.e. **cd /my_app**):

- **install**: reads the **lpi.byml** file and installs/re-installs the plugins listed in it, if their version number
  has changed. Note: it will not remove any plugin that's not listed in the file. If the **lpi.byml** file doesn't exist
  yet, it will be created and filled with the planet information found in the universe directory of the current app.

- **install <planetId>(:<versionExpression>?)**: installs the planet identified by the given planetId and
  optional [versionExpression](#version-expression).

- **import**: reads the **lpi.byml** file and imports/re-imports the plugins listed in it, if their version number has
  changed. Note: it will not remove any plugin that's not listed in the file. Note2: the plugins will be imported in the
  current app, and in the global directory if they aren't there yet. 
  If the imported planet already exists in the current app, the planet of the current app will be removed so that the new planet can be imported.
  
  The import and remove procedure are described in greater details in the [import/remove a planet](#the-importremove-planet-procedure) section of this document.

- **import <planetId>(:<versionExpression>?)**: imports the planet identified by the given planetId and
  optional [versionExpression](#version-expression).
- **import <planetId>(:<versionExpression>?) -g**: the g flag means global, this command imports the planet identified
  by the given planetId and optional [versionExpression](#version-expression)
  in the global directory rather than in the current app.
  
- **init**: creates the **lpi.byml** file if it doesn't exist, at the root of the application.
- **uninstall <planetId>**: uninstall the planet which id is given
- **remove <planetId>**: uninstall and remove the directory of the planet which id is given
- **dir**: opens the global directory, using the **MacOs** open command
- **list**: lists all planets imported in the current application, along with their version number
- **convert <universePath>**: converts all the planets found in the given universePath, and put them in the global
  directory. The universePath is the path to a directory with the following filesystem structure
  ```
    (universePath/)
    - $galaxy/
    ----- $planet/
    ----- ...
    - ...
  ```


- **upgrade-master**: compares the web and local versions of the [master file](#the-master-dependency-file), and
  upgrades the local version if necessary

Note: the following commands will re-write the **lpi.byml** file accordingly: **install**, **import**, **uninstall**, **
remove**.




The import/remove planet procedure
-------
2020-12-07


The **assets/map** directory is an unofficial convention used by all planets in the **Ling** galaxy.

The promise is that anything stored into this directory will be mapped to the current application when the planet is imported into that application.

This trick was used by the [Uni2 installer](https://github.com/lingtalfi/Uni2): [uni](https://github.com/lingtalfi/universe-naive-importer).

Since our plugin is an installer too, it's our pleasure to also implement this feature, so that plugin authors can continue using the **assets/map** directory
to map files into the target application.


It's only logical then that when we remove the planet (or un-import it to be more precise), we also remove all the files copied from the **assets/map** to the application.


### Import

With that in mind, the import procedure for a planet ABC is the following:

- check whether there is already a planet ABC in the app, if so remove it (see the remove section below)
- copy the planet ABC directory to the app, then copy the **assets/map** files into the app, as described earlier 


### Remove

- remove all the files copied previously from the **assets/map** directory of the planet to the application
- remove the planet ABC directory from the app









How to install
---------
2020-12-03

This plugin is particular as its main use is via the command line.

Here is what I do personally, and I recommend you to the same.

Create a bash alias:

```bash
alias lpi='php -f ./scripts/Ling/Light_PlanetInstaller/lpi.php -- '
```

From there, what you can do is "cd" to the app, and then use the lpi command.

```bash 
cd /path_to_your_app
lpi help
lpi install Ling.BabyYaml
...
```

The bernoni problem: what happens in case of conflict?
--------------
2020-12-04

Since we are handling version numbers, some conflict problem can occur.

Let me first expose the problem, and then explain our plugin approach to this problem.

Imagine 4 plugins: P1, P2, PA and PB, and here their dependency graph:

- P1:
    - depends on: PA and PB

- PA:
    - depends on: P2 version 1.1.0

- PB:
    - depends on: P2 version 4.2.0

As you can see both plugins PA and PB depends on the P2 plugin, but with a different version number.

The problem is that when you call our plugin to import P1, since it's not really feasible to have both P2 versions in
the same app, we will have to choose what we want to do.

Our approach is to take the latest version, so in this case P2 in version 4.2.0 hoping that it will work for you. It
might as well not work at all though, and so we also log every version conflict (such as this one) that we found during
the import/install process, so that the user of our plugin knows exactly where the potential conflicts are.

I'm not sure, but I believe that this version incompatibility problem cannot be resolved entirely (i.e. that it's a
problem that's a direct consequence of allowing a plugin to evolve in the first place), and therefore this approach is
the best workaround that I've found around it so far.





The **lpi-deps.byml** file
-----------
2020-12-04 -> 2020-12-14




Our system doesn't depend on a third service, such as a database, to resolve dependencies.
Instead, dependencies are declared by each planet, via a dependency file: **lpi-deps.byml**.


This takes the form of a **lpi-deps.byml** file to place at the root of your planet, and which looks like this:

```yaml
1.1.0:
    - Ling:Planet1:1.5.0
    - Ling:Planet2:1.1.0
1.2.0:
    - Ling:Planet1:1.5.0
    - Ling:Planet2:1.1.0

```

You get the idea. Each version of the planet is listed, along with its dependencies. Each dependency is a string, where
the colon symbol (:) is used as a separator for the galaxy, planet, and [version expression](#version-expression).



### what about scalability?

Using a file to store dependencies is okay, but ultimately those dependencies will be stored in php arrays, 
which can only contain a limited number of items before you get an exhausted allocation memory error message.

I don't remember exactly the number, and also it might depend on what it stored exactly but I would guess that
from 0 to 10000 we're safe, and after that, I'm not so sure.

That is to say, if a planet has more than 10000 version numbers, we need to start thinking of another solution
to store version numbers. 

The idea of a database seems logical, but it involves a third party element to store the database, so I prefer to keep
things raw and simple here, and find another solution.

What I came up with, but did not implement yet because for now it's just a fictive case (as I don't have any planet that has that many version numbers yet),
is a system where basically we can split the **lpi-deps.byml** file into multiple files.

The **lpi-deps.byml** file would still be there, and would use a special syntax (yet to define), to point to the sub-files that contain other versions.

So, for instance here is a sketch, just to illustrate the idea (i.e. probably not the final implementation);

```yaml
is_split: true
parts:
    -
        start: 1.0.0
        end: 1.99.768
        location: lpi-deps-1.byml
    -
        start: 2.0.0
        end: 2.4.9
        location: lpi-deps-2.byml
```














The master dependency file
-------------
2020-12-04

The **master dependency** file (aka master) is basically the sum of all the [lpi-deps.byml](#the-lpi-depsbyml-file) files we know
compiled in one big file. The idea is that we don't want to jump from plugin to plugin in order to collect the
dependency tree required to import a planet correctly. This is especially true if you don't use a local cache and you
try to import/install using the web. Jumps in the web are one more http request for every new dependency, it could
potentially become very long to import just one plugin.

That's not our approach. Instead, we compile this file and do only one call to that master file.

This is much faster, but again there is a price to pay, which is that you need to have your planet registered in our
master file before you can import/install it using our plugin.

As for today, we didn't put many thoughts as of how you would do that, so, just send us a request/email I guess, and we
will proceed it.

Its location is defined in the [global configuration](#the-global-configuration).



Its content looks like this:

```yaml
dependencies:
    Ling.Planet1:  
        1.1.0:
            - Ling:Planet1:1.5.0
            - Ling:Planet2:1.1.0
        1.2.0:
            - Ling:Planet1:1.5.0
            - Ling:Planet2:1.1.0
        ...
    ...  
```





How does our plugin resolve the dependencies
----------
2020-12-04

So, when our plugin is asked to import a plugin, it will first read the [master file](#the-master-dependency-file),
and create a dependency tree from it. Then it will import/install the appropriate dependencies, with respect to
the [bernoni problem](#the-bernoni-problem-what-happens-in-case-of-conflict).

That's pretty much it.





The upgrade system
-----------
2020-12-07

The [master file](#the-master-dependency-file) is the file our plugin uses to create the dependency tree
required to install plugins recursively (i.e. when they depend on each other): it's an essential file for the plugin and
is read every time a plugin is installed.

Therefore, our idea was to read it from the [global directory](#the-global-directory) rather than from the web, which
takes longer to process. The price to pay though is that we need to create a master file locally, and we need to
synchronize it with the web version.

We actually use two files for the master:

- one to store the version number only
- one to store the actual dependency tree graph

Using a dedicated file to store the version number only makes it faster to quickly check whether we have the most
up-to-date version of the master.

The location of those files are stored in the [global config](#the-global-configuration), under the **master_path**
and **master_version_path** properties.

The local version of the master file (in the global directory) is a file might be outdated compared to the web version,
which is always up to date by design.

But how do we update the local master file once it's installed?

First, we can manually ask for an upgrade with the **upgrade-master** command.

Then, different users might have different preferences: some users will prefer an automatic upgrade every time it's
available, whereas other users will prefer to be notified when an upgrade is available, and execute the upgrade
manually. Other users maybe want to just do the upgrades manually and never be notified.

We can handle those three cases using the **upgrade_mode** property of the [global conf](#the-global-configuration),
which can have one of the following values:

- auto (by default), will automatically check for new updates of the master file and install them locally, every time a
  command is executed. With this mode, your depdendencies are always up-to-date

- notif: will check for new updates (of the master file) and write a message to the user every time a command is
  executed. But will not install the master locally.

- none: will not do anything

The dependency tree
--------------
2020-12-07

This is more a developer thing, than a user thing, as you don't need to know about the dependency tree in order to use
our plugin's cli.

The dependency tree is basically the list of planets to install/import, in the order they should be installed/imported.

The order matters, especially when installing things, as some plugins expect their "parent" to be installed first before
they can install themselves properly.

In other words, the dependency tree lists the parents first.

Not surprisingly, the list is created by looking at the dependencies first, recursively.

So, given the following graph for instance:

- A:
    - B
    - C

- B:
    - C
    - D
    - E

- C: no dependency

- D: no dependency
- E: no dependency

We basically, if we install A, we do a process similar to this:

- read A's deps: B, C
    - read B's deps: C, D, E
    - read C's deps: no dependency, then append C to the list
    - read D's deps: no dependency, then append D to the list
    - read E's deps: no dependency, then append E to the list
    - then append B to the list (now that all its dependencies have been processed)
- read C's deps: but it's already in the list so skip
- then append A to the list (now that all its dependencies have been processed)

Resulting list:

- C
- D
- E
- B
- A

I'm not sure whether the theoretical case of cyclic dependency has a concrete pragmatic reality (i.e. A -> B -> C -> D
-> A for instance). But if a plugin calls for a plugin that would cause a cyclic repetition, our algorithm don't follow
the link (which would create an infinite loop), and installs the "offending" plugin instead, as if it was the last item
in the chain.

Note: that's a simplified version of what our plugin do. In reality, we consider the version numbers, and
the [bernoni problem](#the-bernoni-problem-what-happens-in-case-of-conflict).





Readme version numbers, ling style
============
2020-12-08


As far as I can remember, since I've developed [bsr-0](https://github.com/lingtalfi/BumbleBee/blob/master/Autoload/convention.bsr0.eng.md) packages
I've always written the version numbers of my planets in the README.md at the root of the planet directory.

Although it might create some long README file in the end, especially if the planet has a lot of activity,
it turns out that doing so allows me to list the versions of a planet, which is useful now to my installer plugins,
including this **Light_PlanetInstaller** plugin.

In fact, the **Light_PlanetInstaller** plugin relies entirely on this system for some of its packing methods.

So what's the system?

At the end of your readme file, create a history log section like this:

```md

some blabla

History Log
------------------

- 1.292 -- 2020-12-08

  - test Bat update lpi-deps

- 1.291 -- 2020-12-08

  - Update FileSystemTool::copyDir comment


```

It's important that the **history log** section is at the end of your README.md file.
Then, each line starting with a dash followed by a version number basically will be collected, and other lines ignored.














Related
============
2020-12-04

If your prefer, you can use the [uni tool](https://github.com/lingtalfi/universe-naive-importer), which doesn't care
about version numbers (it just import the latest version every time), but the cli is more complex (too many commands),
and maybe not as cool as ours (because we have the **lpi.byml** file and **uni** doesn't).

