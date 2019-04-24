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


## Updating the Project

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
1. Log into the **Plesk** server, find the website **conferencesuite.asce.org**, and open the **Git** plugin.
2. Click the **Pull Updates** button, then the **Deploy from Repository** button.
3. Log into the SSH server on the command line
4. Run the following bash commands:
	```bash
	$ cd ./conferencesuite.asce.org/
	$ composer install
	$ cd ./web/themes/custom/legacy/
	$ npm ci
	$ npm run build
	```
