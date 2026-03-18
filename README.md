1. Am clonat proiectul din Git Hub
$ git clone https://github.com/DanielK016/Astral.git
Cloning into 'Astral'...
remote: Enumerating objects: 6, done.
remote: Counting objects: 100% (6/6), done.
remote: Compressing objects: 100% (2/2), done.
remote: Total 6 (delta 0), reused 0 (delta 0), pack-reused 0 (from 0)
Receiving objects: 100% (6/6), done.

2. Am deschis proiectul
$ cd Astral

3. Am facut un commit
$ echo "# Proiect" > README.md

$ git add .
warning: in the working copy of 'README.md', LF will be replaced by CRLF the next time Git touches it

$ git commit -m "Initial commit"
[main 20813fc] Initial commit
 1 file changed, 1 insertion(+), 1 deletion(-)

4. Am adaugat commitul
$ git push origin main
Enumerating objects: 5, done.
Counting objects: 100% (5/5), done.
Writing objects: 100% (3/3), 256 bytes | 256.00 KiB/s, done.
Total 3 (delta 0), reused 0 (delta 0), pack-reused 0 (from 0)
To https://github.com/DanielK016/Astral.git
   b9f7fe5..20813fc  main -> main

5. Am creat branch-ul BackEnd
$ git checkout -b BackEnd
Switched to a new branch 'BackEnd'

$ git push -u origin BackEnd
Total 0 (delta 0), reused 0 (delta 0), pack-reused 0 (from 0)
remote:
remote: Create a pull request for 'BackEnd' on GitHub by visiting:
remote:      https://github.com/DanielK016/Astral/pull/new/BackEnd
remote:
To https://github.com/DanielK016/Astral.git
 * [new branch]      BackEnd -> BackEnd
branch 'BackEnd' set up to track 'origin/BackEnd'.

6. Am creat branch-ul FrontEnd
$ git checkout -b FrontEnd
Switched to a new branch 'FrontEnd'

$ git push -u origin FrontEnd
Total 0 (delta 0), reused 0 (delta 0), pack-reused 0 (from 0)
remote:
remote: Create a pull request for 'FrontEnd' on GitHub by visiting:
remote:      https://github.com/DanielK016/Astral/pull/new/FrontEnd
remote:
To https://github.com/DanielK016/Astral.git
 * [new branch]      FrontEnd -> FrontEnd
branch 'FrontEnd' set up to track 'origin/FrontEnd'.

7. Am creat branch-ul Tester
$ git checkout -b Tester
Switched to a new branch 'Tester'

$ git push -u origin Tester
Total 0 (delta 0), reused 0 (delta 0), pack-reused 0 (from 0)
remote:
remote: Create a pull request for 'Tester' on GitHub by visiting:
remote:      https://github.com/DanielK016/Astral/pull/new/Tester
remote:
To https://github.com/DanielK016/Astral.git
 * [new branch]      Tester -> Tester
branch 'Tester' set up to track 'origin/Tester'.

8. Am creat branch-ul Git
$ git checkout -b Git
Switched to a new branch 'Git'

$ git push -u origin Git
Total 0 (delta 0), reused 0 (delta 0), pack-reused 0 (from 0)
remote:
remote: Create a pull request for 'Git' on GitHub by visiting:
remote:      https://github.com/DanielK016/Astral/pull/new/Git
remote:
To https://github.com/DanielK016/Astral.git
 * [new branch]      Git -> Git
branch 'Git' set up to track 'origin/Git'.
