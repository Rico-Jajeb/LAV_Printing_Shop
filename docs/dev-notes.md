
Category Data Flow (GET)

This module handles retrieving category data for products in the LAV Printing Shop system.
It follows a Controller → Service → Repository → Model architecture to separate responsibilities:

* Controller → handles HTTP requests and responses (Inertia pages).

* Service → contains business logic for categories.

* Repository → handles database queries for categories.

* Model → represents the Category table in the database (Eloquent ORM).

