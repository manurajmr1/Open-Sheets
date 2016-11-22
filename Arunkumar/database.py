import MySQLdb

def create_cursor():
    # Creating database connection
    db = MySQLdb.connect("localhost","root","a5qE9iXUFkg0wKL","estimation_tool" )

    # Creating a cursor object using cursor() method
    cr = db.cursor(MySQLdb.cursors.DictCursor)

    return cr

    # execute SQL query using execute() method.
    # cursor.execute("SELECT VERSION()")
    #
    # # Fetch a single row using fetchone() method.
    # data = cursor.fetchone()
    #
    # print "Database version : %s " % data
    #
    # # disconnect from server
    # db.close()
