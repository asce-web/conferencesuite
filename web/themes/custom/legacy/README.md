# Legacy
Conference website design theme and style guide.


## View the Project

### Get It & Build It
```bash
$ git clone https://github.com/asce-web/conferencesuite.git
$ cd ./conferencesuite/
$ composer install
$ drush cim # enter yes
$ cd ./web/themes/custom/legacy/
$ npm ci
$ npm run build
```

### Serve It
In MAMP, set up a host with the document root `<path>/<to>/conferencesuite/web`.

### View the Sample Site
```
http://localhost:9000/
```

### View the Style Guide
```
http://localhost:9000/themes/custom/legacy/docs/styleguide/
```

### View the API Docs
```
http://localhost:9000/themes/custom/legacy/docs/api/
```


## Update the Project

### Bump & Push
1. Make sure that the version number is appropriate.
	The version number is found in 2 files, under the `/web/themes/custom/legacy/` directory:
	`package.json` and `package-lock.json`. Make sure you update both files.
	- For Major releases (breaking changes), bump the major version number `X.y.z`.
	- For Minor releases (non-breaking but new features), bump the minor version number `x.Y.z`.
	- For Patch releases (bugfixes only), bump the patch version number `x.y.Z`.
2. Add the changes and commit the bump as a completely separate commit.
	```bash
	$ git commit -m 'v1.0.0' # whatever the version number is
	```
2. Merge in the branch into `master`. **The merge should not be a fast-forward.**
	```bash
	$ git checkout master
	$ git merge --no-ff branch-name # use the actual branch name, like `dev` or `fix`
	```
	The merge should be successful (without conflicts), since `master` should always be behind other branches.
3. Add a git tag.
	```bash
	$ git tag v1.0.0 # whatever the version number is
	```
4. Merge `master` back into `dev`, `fix`, and any other branches you want to keep updated.
	```bash
	$ git checkout dev
	$ git merge --ff master
	$ git checkout fix
	$ git merge --ff master
	```
5. Push all branches and tags to GitHub.
	```bash
	$ git push origin master fix dev v1.0.0 # use the actual tag name
	```
6. Log in to GitHub.com and navigate to https://github.com/asce-web/bechtel/releases
7. Provide release notes for the newly-released tag.

### Deploy
1. Log in to the **Plesk** server, find the website **conferencesuite.asce.org**, and open the **Git** plugin.
2. Click the **Pull Updates** button, then the **Deploy from Repository** button.
3. Log in to the SSH server on the command line.
4. Run the following bash commands:
	```bash
	$ cd ./conferencesuite.asce.org/
	$ composer install
	$ cd ./web/themes/custom/legacy/
	$ npm ci
	$ npm run build
	```


## Receive Updates
For each Drupal 8 conference site (live, staged, and dormant):

1. Log in to the site with an admin account.
2. If a database update is required, navigate to `/update.php` and perform the update. Otherwise, skip this step.
3. Rebuild the cache. (This may take some time depending on how busy the server is.)
4. If there are any module updates required, perform the following substeps. Otherwise, skip this step.
   1. Navigate to **Configuration → Development → Features**
   2. Under Bundle, select **Chewie**
   3. Navigate to **Differences** tab.
   4. Select the differences you want to pull in.
      - **Caution**: Do not pull in diffs from `legacy.settings`, as this will reset theme information.
      - **Caution**: Do not pull in diffs from `google_tag.settings`, as this will reset the GTM ID.
   5. Hit **Import changes**.
   6. Rebuild the cache (again).
5. Inspect the site to ensure that the updates have been received.

**Note**: For best results, perform the steps above in parallel, with each conference site in an open browser tab.
For example, do Step 1 for all sites, then Step 2, etc. This technique tends to be faster, because you can be doing work on one site while another site is loading/processing.
