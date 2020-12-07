+_07_12_2020

### Context

Currently all the ADR files have the date inside their name and follow the "context, decision, consequences" pattern.

### Decision

Put an incremental id for each file in addition of the type (PROJECT, ARCHITECTURAL, TECHNICAL). 
Inside the file put the date and a marker to know if it is an important ADR or not, this will be the fisrt line of each ADR

\* = important <br>
\+ = normal 

07_12_2020 = [day]\_[month]\_[year]

example : 

*_07_12_2020 : important ADR created the 7 december of 2020

### Consequences 

Refactor all the previous ADRs with the new pattern. 
With this decision, it will be easier to automate the documentation.

