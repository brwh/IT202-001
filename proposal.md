
# Project Name: Simple Bank
## Project Summary: This project will create a bank simulation for users. They’ll be able to have various accounts, do standard bank functions like deposit, withdraw, internal (user’s accounts)/external(other user’s accounts) transfers, and creating/closing accounts.

## Github Link: https://github.com/brwh/IT202-001 (Prod Branch of Project Folder) 
## Project Board Link: https://github.com/brwh/IT202-001/projects/1    
## Website Link: https://bw286-prod.herokuapp.com/ (Heroku Prod of Project folder)
## Your Name: Brad Whitman - Video Presentation Link: https://youtu.be/TmHdCwD20LE

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

      - ![image](https://user-images.githubusercontent.com/90637306/146628152-ddfe285d-72b1-4511-853b-53892a2976c4.png) 

  

    - Form should include a field for a positive numeric value
    - System shouldn’t allow the user to transfer more funds than what’s available in AccountSrc

      - ![image](https://user-images.githubusercontent.com/90637306/146628184-aac3b7d1-615f-4a52-91b0-c0dbb74b1025.png)  FLASH NOT WORKING, BUT WILL NOT ALLOW USER TO SUBMIT QUERY - USING ALERT CURRENTLY




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

      - ![image](https://user-images.githubusercontent.com/90637306/146628127-ca4360fd-f6ee-4c8e-9efc-856a6728370e.png) - FLASH NOT WORKING, BUT WILL NOT ALLOW USER TO SUBMIT QUERY - USING ALERT CURRENTLY





 
 

**Milestone 4**
- User can set their profile to be public or private (will need another column in Users table)
  - ![image](https://user-images.githubusercontent.com/90637306/147024684-e9a9d9f3-1562-46d5-80b3-5f3e90b2cd40.png)

  - If public, hide email address from other users
- User will be able open a savings account
  - System will generate a 12 digit/character account number per the existing rules (see Checking Account above)
  - System will associate the account to the user
  - Account type will be set as savings
    - all conditions are answered in this picture: 
      - ![image](https://user-images.githubusercontent.com/90637306/147016854-f2d5d431-6393-4f0e-84fe-4debbdb834b0.png)

  - Will require a minimum deposit of $5 (from the world account)
    - Entry will be recorded in the Transaction table in a transaction pair (per notes below)
      - ![image](https://user-images.githubusercontent.com/90637306/147017327-9a949555-6166-4220-a37d-724ecc35b45a.png)
      - ![image](https://user-images.githubusercontent.com/90637306/147017362-55c82d23-0578-4073-8d7f-6894f3b452ee.png)

    - Account Balance will be updated based on SUM of BalanceChange of AccountSrc
      - ![image](https://user-images.githubusercontent.com/90637306/147017696-ca4ed329-c152-410f-90df-553142dbbe37.png)
      
  - System sets an APY that’ll be used to calculate monthly interest based on the balance of the account
    - ![image](https://user-images.githubusercontent.com/90637306/147024165-d37412cc-6471-47d1-a794-be2a288fec36.png)

    - Recommended to create a table for “system properties” and have this value stored there and fetched when needed, this will allow you to have an admin account change the value in the future)
  - User will see user-friendly error messages when appropriate
  - User will see user-friendly success message when account is created successfully
    - Redirect user to their Accounts page
- User will be able to take out a loan
  - ![image](https://user-images.githubusercontent.com/90637306/147024943-69b17eaa-a038-4e96-9208-e4e4f2b130b7.png)

  - System will generate a 12 digit/character account number per the existing rules (see Checking Account above)
  - Account type will be set as loan
  - Will require a minimum value of $500
    - ![image](https://user-images.githubusercontent.com/90637306/147024976-a84654b9-777d-4673-b908-5e171f113bc8.png)

  - System will show an APY (before the user submits the form)
    -  This will be used to add interest to the loan account
      - ![image](https://user-images.githubusercontent.com/90637306/147022016-80e5e7a6-ac2c-4bf1-9f23-2f5be66bf24d.png)
 
    - Recommended to create a table for “system properties” and have this value stored there and fetched when needed, this will allow you to have an admin account change the value in the future)
  - Form will have a dropdown of the user’s accounts of which to deposit the money into
    - I made loan accounts its own thing, and had the user pay it off in a special page
      - 
  - **Special Case for Loans**:
    -  Loans will show with a positive balance of what’s required to pay off (although it is a negative since the user owes it)
      -  ![image](https://user-images.githubusercontent.com/90637306/147025851-155bf8d3-6fe1-4a2b-a3a2-897d2938cb57.png)

    - User will transfer funds to the loan account to pay it off
      - ![image](https://user-images.githubusercontent.com/90637306/147025861-9120100f-d4ed-464f-a600-3f490c92b493.png)
      - ![image](https://user-images.githubusercontent.com/90637306/147026064-93424b35-ebad-47af-aed9-945d57ef2634.png)

    - Transfers will continue to be recorded in the Transactions table
      - ![image](https://user-images.githubusercontent.com/90637306/147026125-4a86ac94-58a4-4ab1-91f3-ba492ffb7208.png)

    - Loan account’s balance will be the balance minus any transfers to this account
      -  ![image](https://user-images.githubusercontent.com/90637306/147026236-27d1f5f8-fdfd-4f66-aad5-aa4ccc0ca5ba.png)
      - loan balance is the current balance of that loan account
    - Interest will be applied to the current loan balance and add to it (causing the user to owe more)
      - ![image](https://user-images.githubusercontent.com/90637306/147026323-5b55ff93-0c5e-4291-93e1-83e256754f89.png)

    - A loan with 0 balance will be considered paid off and will not accrue interest and will be eligible to be marked as closed
      - ![image](https://user-images.githubusercontent.com/90637306/147026367-10924b6e-ea62-4fcc-9d06-d4bafecf1a43.png)

    - User can’t transfer more money from a loan once it’s been opened and a loan account should not appear in the Account Source dropdowns
      - ![image](https://user-images.githubusercontent.com/90637306/147026435-0de614e5-3608-4d63-b6b3-e30097bf5fd2.png)

  - User will see user-friendly error messages when appropriate
    - ![image](https://user-images.githubusercontent.com/90637306/147024805-b61ce2bb-c6bf-42a7-bd90-fd827310e999.png)

  - User will see user-friendly success message when account is created successfully
    - ![image](https://user-images.githubusercontent.com/90637306/147025101-3acbbe7d-8b1a-479b-a85a-ce25e3af609c.png)

    - Redirect user to their Accounts page
  
- Listing accounts and/or viewing Account Details should show any applicable APY
  - ![image](https://user-images.githubusercontent.com/90637306/147026532-bb2a81ba-c809-4d8c-87ea-fe42e183d0e5.png)
 
- User will be able to close an account
  - ![image](https://user-images.githubusercontent.com/90637306/147026556-a41f724f-1cb4-4132-9fba-9675ed48b609.png)
 
  - User must transfer or withdraw all funds out of the account before doing so
    - ![image](https://user-images.githubusercontent.com/90637306/147026683-413080fc-07ea-4e3e-90e2-081994606ea5.png)

  - Account should have a column “active” that will get set as false.
    - All queries for Accounts should be updated to pull only “active” = true accounts (i.e., dropdowns, My Accounts, etc)
    - Do not delete the record, this is a soft delete so it doesn’t break transactions
  - Closed accounts don’t show up anymore
  - ![image](https://user-images.githubusercontent.com/90637306/147029548-7e5051f0-bd7e-4f0c-96e0-addfc4bf860e.png)
   - ![image](https://user-images.githubusercontent.com/90637306/147029618-6898d389-11b3-40da-8ed4-6b1f471411f9.png) - I CLOSED A CHECKINGS ACCOUNT AND IT IS NO LONGER THERE

  - If the account is a loan, it must be paid off in full first
    - - ![image](https://user-images.githubusercontent.com/90637306/147026683-413080fc-07ea-4e3e-90e2-081994606ea5.png)
  
- Admin role (leave this section for last)
  - Will be able to search for users by firstname and/or lastname
  - Will be able to look-up specific account numbers (partial match).
  - Will be able to see the transaction history of an account
  - Will be able to freeze an account (this is similar to disable/delete but it’s a different column)
    - Frozen accounts still show in results, but they can’t be interacted with.
    - [Dev note]: Will want to add a column to Accounts table called frozen and default it to false
      - Update transactions logic to not allow frozen accounts to be used for a transaction
        - ![image](https://user-images.githubusercontent.com/90637306/147029899-51eeebac-afef-429f-9c76-633b4da6f639.png)

  - Will be able to open accounts for specific users
  - Will be able to deactivate a user
    - Requires a new column on the Users table (i.e., is_active)
      - ![image](https://user-images.githubusercontent.com/90637306/147030402-44db5ea7-7717-4921-b025-0092915bf495.png)

    - Deactivated users will be restricted from logging in
      - ![image](https://user-images.githubusercontent.com/90637306/147029981-bec5c16c-d803-437e-bb95-b767d466c327.png)
      - 
      - “Sorry your account is no longer active” 
      - ![image](https://user-images.githubusercontent.com/90637306/147030382-8c892f72-8b77-4d2d-b946-15fd411aae75.png)

 

 









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
