# Project Name: Simple Bank
## Project Summary: This project will create a bank simulation for users. They’ll be able to have various accounts, do standard bank functions like deposit, withdraw, internal (user’s accounts)/external(other user’s accounts) transfers, and creating/closing accounts.

## Github Link: https://github.com/brwh/IT202-001
## Project Board Link: https://github.com/brwh/IT202-001/projects
## Website Link: https://dashboard.heroku.com/apps/bw286-prod
## Your Name:Brad Whitman

<!--
### Line item / Feature template (use this for each bullet point)
#### Don't delete this

- [ ] \(mm/dd/yyyy of completion) Feature Title (from the proposal bullet point, if it's a sub-point indent it properly)
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show
### End Line item / Feature Template
--> 
### Proposal Checklist and Evidence

- Milestone 1 - X
- Milestone 2:
Create the Accounts table (id, account_number [unique, always 12 characters], user_id, balance (default 0), account_type, created, modified)
Project setup steps:
Create these as initial setup scripts in the sql folder
Create a system user if they don’t exist (this will never be logged into, it’s just to keep things working per system requirements)
Create a world account in the Accounts table created below (if it doesn’t exist)
Account_number must be “000000000000”
User_id must be the id of the system user
Account type must be “world”
Create the Transactions table (see reference below)
Dashboard page
Will have links for Create Account, My Accounts, Deposit, Withdraw Transfer, Profile
Links that don’t have pages yet should just have href=”#”, you’ll update them later
User will be able to create a checking account
System will generate a unique 12 digit account number
Options (strike out the option you won’t do):
Option 1: Generate a random 12 digit/character value; must regenerate if a duplicate collision occurs
Option 2: Generate the number based on the id column; requires inserting a null first to get the last insert id, then update the record immediately after
System will associate the account to the user
Account type will be set as checking
Will require a minimum deposit of $5 (from the world account)
Entry will be recorded in the Transaction table as a transaction pair (per notes below)
Account Balance will be updated based on SUM of BalanceChange of AccountSrc
User will see user-friendly error messages when appropriate
User will see user-friendly success message when account is created successfully
Redirect user to their Accounts page
User will be able to list their accounts
Limit results to 5 for now
Show account number, account type and balance
User will be able to click an account for more information (a.ka. Transaction History page)
Show account number, account type, balance, opened/created date
Show transaction history (from Transactions table)
For now limit results to 10 latest
User will be able to deposit/withdraw from their account(s)
Form should have a dropdown of their accounts to pick from
World account should not be in the dropdown
Form should have a field to enter a positive numeric value
For now, allow any deposit value (0 - inf)
For withdraw, add a check to make sure they can’t withdraw more money than the account has
Form should allow the user to record a memo for the transaction
Each transaction is recorded as a transaction pair in the Transaction table per the details below
These will reflect on the transaction history page (Account page’s “more info”)
After each transaction pair, make sure to update the Account Balance by SUMing the BalanceChange for the AccountSrc
This will be done after the insert
Deposits will be from the “world account”
Must fetch the world account to get the id (do not hard code the id as it may change if the application migrates or gets rebuilt)
Withdraws will be to the “world account”
Must fetch the world account to get the id (do not hard code the id as it may change if the application migrates or gets rebuilt)
Transaction type should show accordingly (deposit/withdraw)
Show appropriate user-friendly error messages
Show user-friendly success messages

- Milestone 3
- Milestone 4
### Intructions
#### Don't delete this
1. Pick one project type
2. Create a proposal.md file in the root of your project directory of your GitHub repository
3. Copy the contents of the Google Doc into this readme file
4. Convert the list items to markdown checkboxes (apply any other markdown for organizational purposes)
5. Create a new Project Board on GitHub
   - Choose the Automated Kanban Board Template
   - For each major line item (or sub line item if applicable) create a GitHub issue
   - The title should be the line item text
   - The first comment should be the acceptance criteria (i.e., what you need to accomplish for it to be "complete")
   - Leave these in "to do" status until you start working on them
   - Assign each issue to your Project Board (the right-side panel)
   - Assign each issue to yourself (the right-side panel)
6. As you work
  1. As you work on features, create separate branches for the code in the style of Feature-ShortDescription (using the Milestone branch as the source)
  2. Add, commit, push the related file changes to this branch
  3. Add evidence to the PR (Feat to Milestone) conversation view comments showing the feature being implemented
     - Screenshot(s) of the site view (make sure they clearly show the feature)
     - Screenshot of the database data if applicable
     - Describe each screenshot to specify exactly what's being shown
     - A code snippet screenshot or reference via GitHub markdown may be used as an alternative for evidence that can't be captured on the screen
  4. Update the checklist of the proposal.md file for each feature this is completing (ideally should be 1 branch/pull request per feature, but some cases may have multiple)
    - Basically add an x to the checkbox markdown along with a date after
      - (i.e.,   - [x] (mm/dd/yy) ....) See Template above
    - Add the pull request link as a new indented line for each line item being completed
    - Attach any related issue items on the right-side panel
  5. Merge the Feature Branch into your Milestone branch (this should close the pull request and the attached issues)
    - Merge the Milestone branch into dev, then dev into prod as needed
    - Last two steps are mostly for getting it to prod for delivery of the assignment 
  7. If the attached issues don't close wait until the next step
  8. Merge the updated dev branch into your production branch via a pull request
  9. Close any related issues that didn't auto close
    - You can edit the dropdown on the issue or drag/drop it to the proper column on the project board
