*_14_12_2020

# Remove phpspec add pest

### Context

I'm using phpspec for the TDD

### Decision

I decide to remove phpspec and use pest instead 

### Why

Cause phpspec create a test for each class, so your code is very tight with the tests  
And pest auto-reload each time a file change. 

### Consequences 

I remove phpspec and require pest