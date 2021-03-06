# ACSF Setup

To configure a project to run on ACSF, perform the following steps after initially setting up BLT:

1. Execute `blt recipes:acsf:init:all` from the project root.
1. Create a custom profile:
    - If you are using Lightning, create a custom sub-profile as described [here](https://docs.acquia.com/lightning/subprofile).
    - For non-Lightning use cases, a profile can be generated [via Drupal Console](https://hechoendrupal.gitbooks.io/drupal-console/content/en/commands/generate-profile.html).
1. Add `acsf` as a dependency for your profile.
1. Modify the `profile` key under `project` in `blt/blt.yml` to use the newly created custom profile. See example below with a profile named `mycustomprofile`:

        project:
          machine_name: blted10
          prefix: BLT
          human_name: 'BLTed 10'
          profile:
            name: mycustomprofile

   Note that if you are using configuration management, you should set `project.profile.name` on a per-site basis by creating `docroot/sites/*/blt.yml` for each site as described in the [multisite readme](multisite.md). Although ACSF does not use traditional Drupal multisite directories, BLT still uses `blt.yml` files placed in these directories to manage BLT configuration for each site and for various purposes when run during ACSF factory hooks, such as to determine which profile Config Split to activate.

1. Deploy to Cloud using `blt artifact:deploy`. (Code can also be deployed via a [Continuous Integration setup](http://blt.readthedocs.io/en/stable/readme/deploy/#continuous-integration).)
1. Use ACSF's "update code" feature to push the artifact out to sites.
1. When creating a new site, select your custom profile as the profile.

In all other respects, BLT treats ACSF installations as multisite installations. To finish setup, including to set up a local development environment for your ACSF project, follow the steps in the [multisite readme](multisite.md).

### Resources

* [Site Factory Documentation](https://docs.acquia.com/site-factory/)
* [Acquia Cloud Site Factory Connector Module](https://www.drupal.org/project/acsf)
