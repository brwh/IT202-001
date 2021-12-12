
# Project Name: Simple Bank
## Project Summary: This project will create a bank simulation for users. They’ll be able to have various accounts, do standard bank functions like deposit, withdraw, internal (user’s accounts)/external(other user’s accounts) transfers, and creating/closing accounts.

## Github Link: https://github.com/brwh/IT202-001 (Prod Branch of Project Folder) 
## Project Board Link: https://github.com/brwh/IT202-001/projects/1    
## Website Link: https://bw286-prod.herokuapp.com/ (Heroku Prod of Project folder)
## Your Name: Brad Whitman

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

**Milestone 1**
  - User will be able to register a new account
    - Form Fields
      - Username, email, password, confirm password (other fields optional) ![image](https://user-images.githubusercontent.com/90637306/142954878-30062c1d-ae6c-4958-96f9-9cdbfdc42c23.png)

      - Email is required and must be validated - ![image](https://user-images.githubusercontent.com/90637306/142955041-e534a09d-04b1-4f0b-b4fc-f6885298ea5a.png)
       ![image](https://user-images.githubusercontent.com/90637306/142955069-09a52d59-ad29-42a2-9fbe-37c343d086bd.png)

      - Username is required ![image](https://user-images.githubusercontent.com/90637306/142955096-d80aefcd-e8c8-4189-aad3-2587fe63d6eb.png)
        ![image](https://user-images.githubusercontent.com/90637306/142955104-80086a6a-c732-47e7-bef1-ceacf446d713.png)

      - Confirm password’s match ![image](https://user-images.githubusercontent.com/90637306/142955129-44fb6878-4099-4811-8082-2ed4f919d613.png)
      ![image](https://user-images.githubusercontent.com/90637306/142955244-87ea7895-a874-4864-93e4-c0f180d0b955.png)


    - Users Table
      - Id, username, email, password (60 characters), created, modified ![image](https://user-images.githubusercontent.com/90637306/142955295-6de7b48d-007b-4443-8e79-431c5efd0762.png)

     - Password must be hashed (plain text passwords will lose points) ![image](https://user-images.githubusercontent.com/90637306/142955298-907c74e3-ee53-4041-9167-80a127aecd08.png)

     - Email should be unique ![image](https://user-images.githubusercontent.com/90637306/143134827-2f7a7b8f-e388-456e-b73c-e57d53fb5de9.png)

     - Username should be unique ![image](https://user-images.githubusercontent.com/90637306/143134836-5282363a-75be-4fcf-b702-7424a92097ad.png)

     - System should let user know if username or email is taken and allow the user to correct the error without wiping/clearing the form![image](https://user-images.githubusercontent.com/90637306/142955762-128f96d9-c81b-42fb-a970-6e1e1f12e4bd.png) ,   ![image](https://user-images.githubusercontent.com/90637306/142955731-a911d2f2-e3f7-479d-b2e2-fadb276fd1d9.png)
/ ![image](https://user-images.githubusercontent.com/90637306/142955480-9fe78718-6259-4062-97a0-0deeec433614.png) , ![image](https://user-images.githubusercontent.com/90637306/142955716-4a54bea9-f297-4ff7-9986-12b8a72f541c.png)



        - The only fields that may be cleared are the password fields

    - User will be able to login to their account (given they enter the correct credentials)
      - Form
        - User can login with email or username, ![image](https://user-images.githubusercontent.com/90637306/142955802-bb89e6d0-eb99-48fc-8059-02ed852fe807.png)

        
          - This can be done as a single field or as two separate fields
        - Password is required ![image](https://user-images.githubusercontent.com/90637306/142955819-f4dec7e4-0257-4ce7-b30e-0e9ff2b20246.png)

     - User should see friendly error messages when an account either doesn’t exist or if passwords don’t match ![image](https://user-images.githubusercontent.com/90637306/142955913-a48e1855-e443-4d2d-b7ed-ee4df27f4d10.png)

     - Logging in should fetch the user’s details (and roles) and save them into the session.
     - User will be directed to a landing page upon login ![image](https://user-images.githubusercontent.com/90637306/142955937-2198b254-c1ff-4c50-89b1-573527d5c970.png)
        ![image](https://user-images.githubusercontent.com/90637306/142955950-967b8f1b-86c4-4f3c-973c-b34b82064867.png)

      - This is a protected page (non-logged in users shouldn’t have access) if you press back: ![image](https://user-images.githubusercontent.com/90637306/142955997-d4cfa7b8-95b6-4deb-8a7f-0837b90c6cdf.png)

      - This can be home, profile, a dashboard, etc
   - User will be able to logout ![image](https://user-images.githubusercontent.com/90637306/142956020-f8a689c5-76fc-4c3c-b499-e3273f116902.png), ![image](https://user-images.githubusercontent.com/90637306/142956034-15ab015e-33a0-43d5-8f30-1ccf9a1fc37c.png)


    - Logging out will redirect to login page ![image](https://user-images.githubusercontent.com/90637306/142956037-2e79b40e-f896-4897-83f8-6e00eb96470c.png)

    - User should see a message that they’ve successfully logged out
    - Session should be destroyed (so the back button doesn’t allow them access back in) ![image](https://user-images.githubusercontent.com/90637306/142956221-149b6359-42ba-4e01-a216-a1cbd17327de.png) - session is destroyed this is a WIP however

  - Basic security rules implemented
    - Authentication:
      - Function to check if user is logged in 
      - Function should be called on appropriate pages that only allow logged in users ![image](https://user-images.githubusercontent.com/90637306/143984383-6d0fb6f5-ad32-463d-9a79-09b45e9f6998.png)
![image](https://user-images.githubusercontent.com/90637306/143984411-7e315ec1-89d2-4ce2-b37e-bfefa5c880d4.png)  - IF USER SOMEHOW REACHES MAIN DASHBOARD PAGE AND DO NOT HAVE A SESSION THEY WILL BE REDIRECTED TO INDEX.PHP

    - Roles/Authorization:
      - Have a roles table (see below)
 - Basic Roles implemented
  - Have a Roles table	(id, name, description, is_active, modified, created)
  - Have a User Roles table (id, user_id, role_id, is_active, created, modified)
  - Include a function to check if a user has a specific role (we won’t use it for this milestone but it should be usable in the future)
- Site should have basic styles/theme applied; everything should be styled
  - I.e., forms/input, navigation bar, etc
- Any output messages/errors should be “user friendly” 
  - Any technical errors or debug output displayed will result in a loss of points
- User will be able to see their profile
  - Email, username, etc
- User will be able to edit their profile
  - Changing username/email should properly check to see if it’s available before allowing the change
  - Any other fields should be properly validated
  - Allow password reset (only if the existing correct password is provided)
    - Hint: logic for the password check would be similar to login



**Milestone 2**
 - Create the Accounts table (id, account_number [unique, always 12 characters], user_id, balance (default 0), account_type, created, modified)
 - Project setup steps:
    - Create these as initial setup scripts in the sql folder
      - Create a system user if they don’t exist (this will never be logged into, it’s just to keep things working per system requirements)
      - Create a world account in the Accounts table created below (if it doesn’t exist) ![image](https://user-images.githubusercontent.com/90637306/143984543-5def9648-9d4d-4097-8a5f-76fb5f95fe4d.png)

        - Account_number must be “000000000000” 
        - User_id must be the id of the system user
        - Account type must be “world” ![image](https://user-images.githubusercontent.com/90637306/143984581-43e5373b-b253-4ec9-ac19-6f6832bf29c1.png)

 - Create the Transactions table (see reference below) ![image](https://user-images.githubusercontent.com/90637306/143984630-ce9fe97a-8474-42d5-b7c6-03a41f2e9f74.png)

 - Dashboard page
  - Will have links for Create Account, My Accounts, Deposit, Withdraw Transfer, Profile ![image](https://user-images.githubusercontent.com/90637306/143984660-efc2047d-2974-4f3e-8284-43b974454fc9.png)

    - Links that don’t have pages yet should just have href=”#”, you’ll update them later
 - User will be able to create a checking account ![image](https://user-images.githubusercontent.com/90637306/143984686-4dbae453-ea24-4e1b-90e4-6761ab528011.png)

  - System will generate a unique 12 digit account number ![image](https://user-images.githubusercontent.com/90637306/143984724-7292dd01-7a2e-40ee-99ef-da790f4d20d6.png)
![image](https://user-images.githubusercontent.com/90637306/143984757-b5145875-a480-4605-8456-dd0550d58376.png) - first image is the function, second is showing how i will prevent collision

    - Options (strike out the option you won’t do):
      - Option 1: Generate a random 12 digit/character value; must regenerate if a duplicate collision occurs
      - ~~Option 2: Generate the number based on the id column; requires inserting a null first to get the last insert id, then update the record immediately after~~
    - System will associate the account to the user
    - Account type will be set as checking 
    - Will require a minimum deposit of $5 (from the world account) ![image](https://user-images.githubusercontent.com/90637306/143984981-6bdda981-79f5-4aea-ac04-b66b76463b7d.png)

      - Entry will be recorded in the Transaction table as a transaction pair (per notes below) ![image](https://user-images.githubusercontent.com/90637306/143985466-ebfbc982-e69a-4af6-9b85-31e1532e92e6.png)

      - Account Balance will be updated based on SUM of BalanceChange of AccountSrc 
     - User will see user-friendly error messages when appropriate
     - User will see user-friendly success message when account is created successfully
      - Redirect user to their Accounts page

 - User will be able to list their accounts ![image](https://user-images.githubusercontent.com/90637306/143985518-7fd47679-44a6-499a-a062-5139e636b995.png)

  - Limit results to 5 for now 
  - Show account number, account type and balance ![image](https://user-images.githubusercontent.com/90637306/143985829-d367126f-1a7e-413d-bfc0-9b287f34d755.png)

 - User will be able to click an account for more information (a.ka. Transaction History page) ![image](https://user-images.githubusercontent.com/90637306/143987679-865ef04e-2446-4785-92e8-2c31d8e97f56.png) - INCOMPLETE

  - Show account number, account type, balance, opened/created date 
  - Show transaction history (from Transactions table)
     - For now limit results to 10 latest
- User will be able to deposit/withdraw from their account(s)
  - Form should have a dropdown of their accounts to pick from 
    - World account should not be in the dropdown
  - Form should have a field to enter a positive numeric value 
    - For now, allow any deposit value (0 - inf)
  - For withdraw, add a check to make sure they can’t withdraw more money than the account has
  - Form should allow the user to record a memo for the transaction ![image](https://user-images.githubusercontent.com/90637306/143987771-43c661a4-e44b-47ff-9600-4ebf77fb87aa.png)

  - Each transaction is recorded as a transaction pair in the Transaction table per the details below ![image](https://user-images.githubusercontent.com/90637306/143987822-1137c5da-9719-44f3-b6eb-b7ffe91bf601.png) -line 312 in transactions.php
![image](https://user-images.githubusercontent.com/90637306/143987860-1e024255-8cf2-45d8-8581-fb1e723e6421.png) - line 273 for withdraw in transactions.php
![image](https://user-images.githubusercontent.com/90637306/143987874-a335a732-f8fa-4dda-ae4b-6ab7de6e07f7.png) - line 239 for deposits in transactions.php, unsure how to prove this further

    - These will reflect on the transaction history page (Account page’s “more info”) ![image](https://user-images.githubusercontent.com/90637306/143988012-9a40fa60-3c21-43b3-ab33-813db222c320.png)

    - After each transaction pair, make sure to update the Account Balance by SUMing the BalanceChange for the AccountSrc ![image](https://user-images.githubusercontent.com/90637306/143988113-5d2984c5-9167-4137-adb6-e826b5b46bdf.png)
 
      - This will be done after the insert
    - Deposits will be from the “world account”  ![image](https://user-images.githubusercontent.com/90637306/143988163-59e331d0-3709-4b90-aeda-865a571b80c4.png)

      - Must fetch the world account to get the id (do not hard code the id as it may change if the application migrates or gets rebuilt) ![image](https://user-images.githubusercontent.com/90637306/143988166-a4c5ec92-7a62-4267-862a-5ca6c62a3ca5.png)

     - Withdraws will be to the “world account”
        - Must fetch the world account to get the id (do not hard code the id as it may change if the application migrates or gets rebuilt)
     - Transaction type should show accordingly (deposit/withdraw)
  - Show appropriate user-friendly error messages
  - Show user-friendly success messages


 




**Milestone 3**
 
 - User will be able to transfer between their accounts
    - Form should include a dropdown first AccountSrc and a dropdown for AccountDest (only accounts the user owns; no world account)
    - Form should include a field for a positive numeric value
    - System shouldn’t allow the user to transfer more funds than what’s available in AccountSrc
    - Form should allow the user to record a memo for the transaction
    - Each transaction is recorded as a transaction pair in the Transaction table
      - These will reflect in the transaction history page   
 - Transaction History page
    - Will show the latest 10 transactions by default
    - User will be able to filter transactions between two dates
    - User will be able to filter transactions by type (deposit, withdraw, transfer)
    - Transactions should paginate results after the initial 10

- User’s profile page should record/show First and Last name
- User will be able to transfer funds to another user’s account
    - Form should include a dropdown of the current user’s accounts (as AccountSrc)
    - Form should include a field for the destination user’s last name
    - Form should include a field for the last 4 digits of the destination user’s account number (to lookup AccountDest)
    - Form should include a field for a positive numerical value
    - Form should allow the user to record a memo for the transaction
    - System shouldn’t let the user transfer more than the balance of their account



 
 

**Milestone 4**
- User can set their profile to be public or private (will need another column in Users table)
  - If public, hide email address from other users
- User will be able open a savings account
  - System will generate a 12 digit/character account number per the existing rules (see Checking Account above)
  - System will associate the account to the user
  - Account type will be set as savings
  - Will require a minimum deposit of $5 (from the world account)
    - Entry will be recorded in the Transaction table in a transaction pair (per notes below)
    - Account Balance will be updated based on SUM of BalanceChange of AccountSrc
  - System sets an APY that’ll be used to calculate monthly interest based on the balance of the account
    - Recommended to create a table for “system properties” and have this value stored there and fetched when needed, this will allow you to have an admin account change the value in the future)
  - User will see user-friendly error messages when appropriate
  - User will see user-friendly success message when account is created successfully
    - Redirect user to their Accounts page
- User will be able to take out a loan
  - System will generate a 12 digit/character account number per the existing rules (see Checking Account above)
  - Account type will be set as loan
  - Will require a minimum value of $500
  - System will show an APY (before the user submits the form)
    -  This will be used to add interest to the loan account
    - Recommended to create a table for “system properties” and have this value stored there and fetched when needed, this will allow you to have an admin account change the value in the future)
  - Form will have a dropdown of the user’s accounts of which to deposit the money into
  - **Special Case for Loans**:
    -  Loans will show with a positive balance of what’s required to pay off (although it is a negative since the user owes it)
    - User will transfer funds to the loan account to pay it off
    - Transfers will continue to be recorded in the Transactions table
    - Loan account’s balance will be the balance minus any transfers to this account
    - Interest will be applied to the current loan balance and add to it (causing the user to owe more)
    - A loan with 0 balance will be considered paid off and will not accrue interest and will be eligible to be marked as closed
    - User can’t transfer more money from a loan once it’s been opened and a loan account should not appear in the Account Source dropdowns
  - User will see user-friendly error messages when appropriate
  - User will see user-friendly success message when account is created successfully
    - Redirect user to their Accounts page
 
- Listing accounts and/or viewing Account Details should show any applicable APY
- User will be able to close an account
  - User must transfer or withdraw all funds out of the account before doing so
  - Account should have a column “active” that will get set as false.
    - All queries for Accounts should be updated to pull only “active” = true accounts (i.e., dropdowns, My Accounts, etc)
    - Do not delete the record, this is a soft delete so it doesn’t break transactions
  - Closed accounts don’t show up anymore
  - If the account is a loan, it must be paid off in full first
  
- Admin role (leave this section for last)
  - Will be able to search for users by firstname and/or lastname
  - Will be able to look-up specific account numbers (partial match).
  - Will be able to see the transaction history of an account
  - Will be able to freeze an account (this is similar to disable/delete but it’s a different column)
    - Frozen accounts still show in results, but they can’t be interacted with.
    - [Dev note]: Will want to add a column to Accounts table called frozen and default it to false
      - Update transactions logic to not allow frozen accounts to be used for a transaction
  - Will be able to open accounts for specific users
  - Will be able to deactivate a user
    - Requires a new column on the Users table (i.e., is_active)
    - Deactivated users will be restricted from logging in
      - “Sorry your account is no longer active” 
 

 









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
=======
# Project Name: Simple Bank
## Project Summary: This project will create a bank simulation for users. They’ll be able to have various accounts, do standard bank functions like deposit, withdraw, internal (user’s accounts)/external(other user’s accounts) transfers, and creating/closing accounts.

## Github Link: https://github.com/brwh/IT202-001 (Prod Branch of Project Folder) 
## Project Board Link: https://github.com/brwh/IT202-001/projects/1    
## Website Link: https://bw286-prod.herokuapp.com/ (Heroku Prod of Project folder)
## Your Name: Brad Whitman

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

**Milestone 1**
  - User will be able to register a new account
    - Form Fields
      - Username, email, password, confirm password (other fields optional)
        - Code: 
        - ![image](https://user-images.githubusercontent.com/90637306/145691279-eac3408e-c3ea-4d84-8317-7de5219a2b9d.png)
        - Live:
        - ![image](https://user-images.githubusercontent.com/90637306/145691307-83181d15-c79b-4077-aa39-a52a9eeb561c.png)



      - Email is required and must be validated
        - Code:
          - with **e_re** = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        - ![image](https://user-images.githubusercontent.com/90637306/145691347-76f05bea-ea93-4046-ac74-5b15954e8389.png) 
                
        - Live:
        - When incorrect format:
          - ![image](https://user-images.githubusercontent.com/90637306/145691328-8b37acf6-34f6-4503-893e-0a62d3871d7e.png)
        - When blank submission:
          - ![image](https://user-images.githubusercontent.com/90637306/145691421-4fdaf01f-7be0-4646-b4bd-39eabda7a390.png)
 
    

      - Username is required 
        - Code:
        - ![image](https://user-images.githubusercontent.com/90637306/145691381-fc1aaa63-8fcc-4612-95e8-d5dc4f498b92.png)
 
        

      - Confirm password’s match
        - Code:
        - With values:, validate function checks to see if the forms password value matches the forms confirm value, if they dont then show this warning
          - ![image](https://user-images.githubusercontent.com/90637306/145691499-842b9d00-7e34-4842-8b1b-df11c718ac8f.png) 
 
          - ![image](https://user-images.githubusercontent.com/90637306/145691480-af4dee40-f484-4bcf-9395-4ca5f9cf4040.png)
  
      


    - Users Table
      - Id, username, email, password (60 characters), created, modified
        -  Users Table:
          - ![image](https://user-images.githubusercontent.com/90637306/145691518-ee2eddcc-ff36-49ca-ad83-1b7cfe5a7e4c.png)
  

      - Password must be hashed (plain text passwords will lose points)
        - Hashed password for all but the world account (since we do not have to log in to it, if theres an issue with this i will change it):
          -    ![image](https://user-images.githubusercontent.com/90637306/145691538-c770c8b6-f6c7-4083-abec-ff9f22df79da.png)


     - Email should be unique
      - with same values as below
      - this code ensures email will be unique - querys through the table of users where email = that email, if any user is grabbed with that email, tells the user the email already exists 
        - ![image](https://user-images.githubusercontent.com/90637306/145692020-0a7df255-3cd0-4d01-8919-af200b97588f.png)
    

     - Username should be unique
      - with these values:
        -   ![image](https://user-images.githubusercontent.com/90637306/145691613-875b19c6-5211-47b3-90c3-77bd4313d195.png)

      - this code ensures username will be unique similiar to email - querys through the table of users where user = that username, if any user is grabbed with that username, tells the user the username already exists  
        - ![image](https://user-images.githubusercontent.com/90637306/145692022-e3b1f8ce-e605-4073-a095-e47875cb19aa.png)
      
        

     - System should let user know if username or email is taken and allow the user to correct the error without wiping/clearing the form
        - ![image](https://user-images.githubusercontent.com/90637306/145692048-81deaaa3-d350-4745-bcfe-5975d38309a4.png)





        - The only fields that may be cleared are the password fields
          - Showing password fields are blank from same submission above:
          - ![image](https://user-images.githubusercontent.com/90637306/145692064-74588c78-1cae-4495-a186-18279a8337e5.png)


    - User will be able to login to their account (given they enter the correct credentials)
      - Form
        - Here is my form of login
          - ![image](https://user-images.githubusercontent.com/90637306/145692155-48fcd1a3-8ad5-4a6d-82ef-1739cadf949f.png)

        - User can login with email or username
          - logging in with user
            - https://imgur.com/a/E0acKKC - VIDEO OF LOGGING IN WITH USERNAME
          - logging in with email
            - https://imgur.com/a/TsMudbX - video of logging in with email
          - This can be done as a single field or as two separate fields - *** was done as two separate fields ***
        - Password is required 
     - User should see friendly error messages when an account either doesn’t exist or if passwords don’t match
      - if account doesnt exist
        -  ![image](https://user-images.githubusercontent.com/90637306/145692953-dd1e2443-c779-4db7-8345-fa5db966cfdd.png)
      - if incorrect password:
        - ![image](https://user-images.githubusercontent.com/90637306/145692961-9b131373-2ea2-4f7c-a9c6-3689e96e4699.png)
  

     - Logging in should fetch the user’s details (and roles) and save them into the session.
      - ![image](https://user-images.githubusercontent.com/90637306/145692989-c1bafaed-e6b7-45a6-afcd-6a7fefc99061.png)
      - ![image](https://user-images.githubusercontent.com/90637306/145693002-2e142985-e163-4978-a43a-b0e6bed47e57.png)
      - not sure how else to show it is fetching this information other than code, above shows the user being stored in session and being able to be grabbed from get_username(); 

     - User will be directed to a landing page upon login
      - ![image](https://user-images.githubusercontent.com/90637306/145693022-655a3ce0-25c2-43bc-9bfe-765d924cccfc.png)


      - This is a protected page (non-logged in users shouldn’t have access)
        - ![image](https://user-images.githubusercontent.com/90637306/145693062-4c002b75-bad3-4eeb-a482-0c72ba67089e.png)
        - again unsure how to show you can check for non-logged in users other than code, if is_logged_in() is true then continue greeting the current user, otherwise notify them they are not logged in

      - This can be home, profile, a dashboard, etc
   - User will be able to logout 
    - https://imgur.com/a/8815G3h  - recording showing logout functions


    - Logging out will redirect to login page 
      - https://imgur.com/a/8815G3h  - recording showing logout brings you to login page

    - User should see a message that they’ve successfully logged out
      - ![image](https://user-images.githubusercontent.com/90637306/145693146-7bc3696b-ee93-4a3d-b6d6-d737d15f4f93.png)

    - Session should be destroyed (so the back button doesn’t allow them access back in)
      - ![image](https://user-images.githubusercontent.com/90637306/145693154-36b9b05e-ecfa-4d21-a759-d18c492cf6a1.png)
      


  - Basic security rules implemented
    - Authentication:
      - Function to check if user is logged in
        -  ![image](https://user-images.githubusercontent.com/90637306/145693170-15b3846b-0423-44e3-b61e-af30926cd792.png)

      - Function should be called on appropriate pages that only allow logged in users
        - ![image](https://user-images.githubusercontent.com/90637306/145693212-a2dd72a3-9821-45d1-b528-bf1a357bd88a.png)
        - function being called on home.php 

    - Roles/Authorization:
      - Have a roles table (see below)
      - roles table below
        - ![image](https://user-images.githubusercontent.com/90637306/145693222-6cee28d7-cda4-4e06-8f93-8bd0804fb4ed.png)

 - Basic Roles implemented
  - Have a Roles table	(id, name, description, is_active, modified, created)
    - ![image](https://user-images.githubusercontent.com/90637306/145693227-3ef4b3cf-bca4-491c-ba9b-6ac093a6a842.png)

  - Have a User Roles table (id, user_id, role_id, is_active, created, modified)
    - ![image](https://user-images.githubusercontent.com/90637306/145693240-71a01cb4-69c5-4a9c-a924-dda845b0529e.png)

  - Include a function to check if a user has a specific role (we won’t use it for this milestone but it should be usable in the future)
    - 
- Site should have basic styles/theme applied; everything should be styled
  - I.e., forms/input, navigation bar, etc - i prove this in all my previous videos above
- Any output messages/errors should be “user friendly” - i prove this in all my previous videos above
  - Any technical errors or debug output displayed will result in a loss of points
- User will be able to see their profile
  - Email, username, etc https://imgur.com/a/s7r8iwX - shows viewing my profile and changing my email
- User will be able to edit their profile - https://imgur.com/a/s7r8iwX
  - Changing username/email should properly check to see if it’s available before allowing the change
  - Any other fields should be properly validated 
  - Allow password reset (only if the existing correct password is provided)
    - Hint: logic for the password check would be similar to login
    - code below shows that the password will not update unless current and confirm password verify
    - ![image](https://user-images.githubusercontent.com/90637306/145694125-3d189792-9846-4141-a6f5-85d8c19ca27c.png)
      - 
      


**Milestone 2**
 - Create the Accounts table (id, account_number [unique, always 12 characters], user_id, balance (default 0), account_type, created, modified)
 - Project setup steps:
    - Create these as initial setup scripts in the sql folder
      - Create a system user if they don’t exist (this will never be logged into, it’s just to keep things working per system requirements)
      - Create a world account in the Accounts table created below (if it doesn’t exist) ![image](https://user-images.githubusercontent.com/90637306/143984543-5def9648-9d4d-4097-8a5f-76fb5f95fe4d.png)

        - Account_number must be “000000000000” 
        - User_id must be the id of the system user
        - Account type must be “world” ![image](https://user-images.githubusercontent.com/90637306/143984581-43e5373b-b253-4ec9-ac19-6f6832bf29c1.png)

 - Create the Transactions table (see reference below) ![image](https://user-images.githubusercontent.com/90637306/143984630-ce9fe97a-8474-42d5-b7c6-03a41f2e9f74.png)

 - Dashboard page
  - Will have links for Create Account, My Accounts, Deposit, Withdraw Transfer, Profile ![image](https://user-images.githubusercontent.com/90637306/143984660-efc2047d-2974-4f3e-8284-43b974454fc9.png)

    - Links that don’t have pages yet should just have href=”#”, you’ll update them later
 - User will be able to create a checking account ![image](https://user-images.githubusercontent.com/90637306/143984686-4dbae453-ea24-4e1b-90e4-6761ab528011.png)

  - System will generate a unique 12 digit account number ![image](https://user-images.githubusercontent.com/90637306/143984724-7292dd01-7a2e-40ee-99ef-da790f4d20d6.png)
![image](https://user-images.githubusercontent.com/90637306/143984757-b5145875-a480-4605-8456-dd0550d58376.png) - first image is the function, second is showing how i will prevent collision

    - Options (strike out the option you won’t do):
      - Option 1: Generate a random 12 digit/character value; must regenerate if a duplicate collision occurs
      - ~~Option 2: Generate the number based on the id column; requires inserting a null first to get the last insert id, then update the record immediately after~~
    - System will associate the account to the user
    - Account type will be set as checking 
    - Will require a minimum deposit of $5 (from the world account) ![image](https://user-images.githubusercontent.com/90637306/143984981-6bdda981-79f5-4aea-ac04-b66b76463b7d.png)

      - Entry will be recorded in the Transaction table as a transaction pair (per notes below) ![image](https://user-images.githubusercontent.com/90637306/143985466-ebfbc982-e69a-4af6-9b85-31e1532e92e6.png)

      - Account Balance will be updated based on SUM of BalanceChange of AccountSrc 
     - User will see user-friendly error messages when appropriate
     - User will see user-friendly success message when account is created successfully
      - Redirect user to their Accounts page

 - User will be able to list their accounts ![image](https://user-images.githubusercontent.com/90637306/143985518-7fd47679-44a6-499a-a062-5139e636b995.png)

  - Limit results to 5 for now 
  - Show account number, account type and balance ![image](https://user-images.githubusercontent.com/90637306/143985829-d367126f-1a7e-413d-bfc0-9b287f34d755.png)

 - User will be able to click an account for more information (a.ka. Transaction History page) ![image](https://user-images.githubusercontent.com/90637306/143987679-865ef04e-2446-4785-92e8-2c31d8e97f56.png) - INCOMPLETE

  - Show account number, account type, balance, opened/created date 
  - Show transaction history (from Transactions table)
     - For now limit results to 10 latest
- User will be able to deposit/withdraw from their account(s)
  - Form should have a dropdown of their accounts to pick from 
    - World account should not be in the dropdown
  - Form should have a field to enter a positive numeric value 
    - For now, allow any deposit value (0 - inf)
  - For withdraw, add a check to make sure they can’t withdraw more money than the account has
  - Form should allow the user to record a memo for the transaction ![image](https://user-images.githubusercontent.com/90637306/143987771-43c661a4-e44b-47ff-9600-4ebf77fb87aa.png)

  - Each transaction is recorded as a transaction pair in the Transaction table per the details below ![image](https://user-images.githubusercontent.com/90637306/143987822-1137c5da-9719-44f3-b6eb-b7ffe91bf601.png) -line 312 in transactions.php
![image](https://user-images.githubusercontent.com/90637306/143987860-1e024255-8cf2-45d8-8581-fb1e723e6421.png) - line 273 for withdraw in transactions.php
![image](https://user-images.githubusercontent.com/90637306/143987874-a335a732-f8fa-4dda-ae4b-6ab7de6e07f7.png) - line 239 for deposits in transactions.php, unsure how to prove this further

    - These will reflect on the transaction history page (Account page’s “more info”) ![image](https://user-images.githubusercontent.com/90637306/143988012-9a40fa60-3c21-43b3-ab33-813db222c320.png)

    - After each transaction pair, make sure to update the Account Balance by SUMing the BalanceChange for the AccountSrc ![image](https://user-images.githubusercontent.com/90637306/143988113-5d2984c5-9167-4137-adb6-e826b5b46bdf.png)
 
      - This will be done after the insert
    - Deposits will be from the “world account”  ![image](https://user-images.githubusercontent.com/90637306/143988163-59e331d0-3709-4b90-aeda-865a571b80c4.png)

      - Must fetch the world account to get the id (do not hard code the id as it may change if the application migrates or gets rebuilt) ![image](https://user-images.githubusercontent.com/90637306/143988166-a4c5ec92-7a62-4267-862a-5ca6c62a3ca5.png)

     - Withdraws will be to the “world account”
        - Must fetch the world account to get the id (do not hard code the id as it may change if the application migrates or gets rebuilt)
     - Transaction type should show accordingly (deposit/withdraw)
  - Show appropriate user-friendly error messages
  - Show user-friendly success messages


 




**Milestone 3**
 
 - User will be able to transfer between their accounts
    - Form should include a dropdown first AccountSrc and a dropdown for AccountDest (only accounts the user owns; no world account)
    - Form should include a field for a positive numeric value
    - System shouldn’t allow the user to transfer more funds than what’s available in AccountSrc
    - Form should allow the user to record a memo for the transaction
    - Each transaction is recorded as a transaction pair in the Transaction table
      - These will reflect in the transaction history page   
 - Transaction History page
    - Will show the latest 10 transactions by default
    - User will be able to filter transactions between two dates
    - User will be able to filter transactions by type (deposit, withdraw, transfer)
    - Transactions should paginate results after the initial 10

- User’s profile page should record/show First and Last name
- User will be able to transfer funds to another user’s account
    - Form should include a dropdown of the current user’s accounts (as AccountSrc)
    - Form should include a field for the destination user’s last name
    - Form should include a field for the last 4 digits of the destination user’s account number (to lookup AccountDest)
    - Form should include a field for a positive numerical value
    - Form should allow the user to record a memo for the transaction
    - System shouldn’t let the user transfer more than the balance of their account



 
 

**Milestone 4**
- User can set their profile to be public or private (will need another column in Users table)
  - If public, hide email address from other users
- User will be able open a savings account
  - System will generate a 12 digit/character account number per the existing rules (see Checking Account above)
  - System will associate the account to the user
  - Account type will be set as savings
  - Will require a minimum deposit of $5 (from the world account)
    - Entry will be recorded in the Transaction table in a transaction pair (per notes below)
    - Account Balance will be updated based on SUM of BalanceChange of AccountSrc
  - System sets an APY that’ll be used to calculate monthly interest based on the balance of the account
    - Recommended to create a table for “system properties” and have this value stored there and fetched when needed, this will allow you to have an admin account change the value in the future)
  - User will see user-friendly error messages when appropriate
  - User will see user-friendly success message when account is created successfully
    - Redirect user to their Accounts page
- User will be able to take out a loan
  - System will generate a 12 digit/character account number per the existing rules (see Checking Account above)
  - Account type will be set as loan
  - Will require a minimum value of $500
  - System will show an APY (before the user submits the form)
    -  This will be used to add interest to the loan account
    - Recommended to create a table for “system properties” and have this value stored there and fetched when needed, this will allow you to have an admin account change the value in the future)
  - Form will have a dropdown of the user’s accounts of which to deposit the money into
  - **Special Case for Loans**:
    -  Loans will show with a positive balance of what’s required to pay off (although it is a negative since the user owes it)
    - User will transfer funds to the loan account to pay it off
    - Transfers will continue to be recorded in the Transactions table
    - Loan account’s balance will be the balance minus any transfers to this account
    - Interest will be applied to the current loan balance and add to it (causing the user to owe more)
    - A loan with 0 balance will be considered paid off and will not accrue interest and will be eligible to be marked as closed
    - User can’t transfer more money from a loan once it’s been opened and a loan account should not appear in the Account Source dropdowns
  - User will see user-friendly error messages when appropriate
  - User will see user-friendly success message when account is created successfully
    - Redirect user to their Accounts page
 
- Listing accounts and/or viewing Account Details should show any applicable APY
- User will be able to close an account
  - User must transfer or withdraw all funds out of the account before doing so
  - Account should have a column “active” that will get set as false.
    - All queries for Accounts should be updated to pull only “active” = true accounts (i.e., dropdowns, My Accounts, etc)
    - Do not delete the record, this is a soft delete so it doesn’t break transactions
  - Closed accounts don’t show up anymore
  - If the account is a loan, it must be paid off in full first
  
- Admin role (leave this section for last)
  - Will be able to search for users by firstname and/or lastname
  - Will be able to look-up specific account numbers (partial match).
  - Will be able to see the transaction history of an account
  - Will be able to freeze an account (this is similar to disable/delete but it’s a different column)
    - Frozen accounts still show in results, but they can’t be interacted with.
    - [Dev note]: Will want to add a column to Accounts table called frozen and default it to false
      - Update transactions logic to not allow frozen accounts to be used for a transaction
  - Will be able to open accounts for specific users
  - Will be able to deactivate a user
    - Requires a new column on the Users table (i.e., is_active)
    - Deactivated users will be restricted from logging in
      - “Sorry your account is no longer active” 
 

 









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

