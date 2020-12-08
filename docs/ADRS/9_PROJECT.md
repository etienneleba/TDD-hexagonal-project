*_08_12_2020

# Create domain folder

### Context 

I want to add the first feature to the project. 


### Decision

I will put all my bounded context inside a folder named _domain_ at the root of the project.
Inside each bounded context there will their own logic and their tests.

### Why

Cause I want that the bounded context are independent to create a modular monolith, like this it will easier to split to microservice one day. 

### Consequences

I will create a folder named _domain_
