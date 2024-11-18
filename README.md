# Prodemy LXP

Learning Xperience Platform by Prodemy 🚀


### Tech Stack

- Laravel
- Tailwind CSS
- Daisy UI
- Inertia JS

---

### Development Guide

#### General Outline

- Create an issue
- Create an issue branch from `development` branch
- Write your code
- Create Pull Request
- Merge the issue branch with `development`
- When ready for production, merge `development` with `main` branch

#### Detail Step By Step

1. Create an issue with either `task` or `bug` label

2. From issue detail page, create new branch that will linked to the issue

3. let the default branch name, then click "Create branch"

4. Sync your local repository with origin, by using these commands:

```bash
# make sure you are on development branch
git checkout development

# pull changes on origin
git pull origin development

# sync local branches with origin
git fetch origin --prune

# checkout to the recently created issue branch
git checkout [issue_number]-[your_issue_name]
```

5. write your code

6. after finishing writing your code, make commit with message that follow the basic on [conventionalcommits.org]([conventionalcommits.org](https://www.conventionalcommits.org/))

```bash
git add .
git commit -m "[type: feat, fix, etc...] : [change description, or just use the issue title]"
```

7. before pushing, make sure you are up to date with `development` branch, and fix the conflict if there is any

```bash
# run this on your issue branch
git pull origin development
git push origin [issue_number]-[your_issue_name]
```

8. visit your branch on github to create a pull request

9. on pull request form, assign your colleague on "reviewer" field

10. as a reviewer, open pull request page to see PR that assigned to you

11. check the PR on your local by using the method described on guide no. 4

12. back to the PR detail page and click "Add your review" button

13. if the PR is rejected the select "Request changes" option, otherwise select "Approved"

14. the author of rejected PR need to send re-review request after fixing their code

15. after PR is reviewed, the issue branch will be merged to `development` branch

16. after successful merge, the issue branch will be deleted, and the issue will be closed automatically

