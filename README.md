# ELMO Software - technical challenge - Pull request review #

### Introduction ###
Looks like you made it past the first interview, yay! 🎉

The goal of this repository is to present you a pull-request and evaluate what you consider for adding features and following best practices.

### Context ###
The goal of this codebase is to be able to calculate an employee's working hours.
For instance, if an employee works 8 hours per day, Monday to Friday, we would expect a number of hours worked per day as a result.

### Pull Request review ###
You are given a task to review a pull request on this repository. When you review, think about the following items:
* what can we do to add more features in the future while maintaining healthy codebase?
* what can we do to make sure we don't break things after code changes?
* what improvements can you think of?

An important part of pull request review is to communicate your thought process to the developers. Feel free to raise as many comments as you want and share your experience. We expect to have a conversation around these changes and assess how your skill and experience would some problems.

### Installation ###
You wouldn't need to install this repository locally to perform code review, but if you're curious and want to try locally:
1. Perform a `git clone` to get this repository.
2. Run `composer dump-autoload` ([Get Composer](https://getcomposer.org/download/))
3. Run `php main.php 2020-12-20 2020-12-26 40 json`: you should see a JSON response: <code>{"2020-12-20T00:00:00+11:00":0,"2020-12-21T00:00:00+11:00":8,"2020-12-22T00:00:00+11:00":8,"2020-12-23T00:00:00+11:00":8,"2020-12-24T00:00:00+11:00":8,"2020-12-25T00:00:00+11:00":8,"2020-12-26T00:00:00+11:00":0}</code>
3. Or run `php main.php 2020-12-20 2020-12-26 40 sum`: you should see: <code>40</code>
