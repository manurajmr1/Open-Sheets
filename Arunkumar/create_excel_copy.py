import xlsxwriter
from flask import Flask,send_file
from database import cr
app = Flask(__name__)

def get_saved_data():
    
 
@app.route('/create_excel')
def create_excel():
    dct_data = get_saved_data() 
    # Create an new Excel file and add a worksheet.
    workbook = xlsxwriter.Workbook('/var/www/hackathon/excel/Project_estimation.xlsx')
    worksheet = workbook.add_worksheet()
    # worksheet2 = workbook.add_worksheet()

    # Widen the first column to make the text clearer.
    worksheet.set_column('A:A', 35)
    worksheet.set_column('B:B', 50)
    worksheet.set_column('C:C', 20)
    worksheet.set_column('E:E', 20)

    # Add a bold format to use to highlight cells.
    trailerStyle = workbook.add_format({'bold': True})
    headerStyle = workbook.add_format({'bg_color': '#178ab4','font_color': 'white','align': 'Center'})
    dataStyle = workbook.add_format({'align': 'Center'})
    totalStyle = workbook.add_format({'align': 'Center','bold': True})
    effortStyle = workbook.add_format({'bg_color': '#f4cb42','align': 'Center'})
    mediumStyle = workbook.add_format({'bg_color': '#f49842','align': 'Center'})
    highStyle = workbook.add_format({'bg_color': '#b53434','align': 'Center','font_color': 'white'})

    dct_data = {'posts': [{'Buffered': 315, 'Testing and Debugging': 54, 'Design': 36, 'Features': 'Export plans', 'Effort': 'H', 'Notes': '- User should be able to export lesson(s) in a suitable format and import these lessons in other instances of ABC LMS in other locations.\nWeeeee', 'Total': 315, 'BA': 45, 'Code and Unit Testing': 180}, {'Buffered': 0, 'Testing and Debugging': 72, 'Design': 48, 'Features': 'Sync with main online server', 'Effort': 'H', 'Notes': '- All contents and lessons will be housed in a central server.', 'Total': 420, 'BA': 60, 'Code and Unit Testing': 240}, {'Buffered': 42, 'Testing and Debugging': 7.2, 'Design': 4.8, 'Features': 'Manual Grading for Objective Assessment', 'Effort': 'M', 'Notes': '- All contents and lessons will be housed in a central server.', 'Total': 42, 'BA': 6, 'Code and Unit Testing': 24}, {'Buffered': 17.5, 'Testing and Debugging': 3, 'Design': 2, 'Features': 'Assessment status', 'Effort': 'M', 'Notes': '- All contents and lessons will be housed in a central server.', 'Total': 17.5, 'BA': 2.5, 'Code and Unit Testing': 10}, {'Buffered': 7, 'Testing and Debugging': 1.2, 'Design': 0.8, 'Features': 'Rename assessments', 'Effort': 'L', 'Notes': '- All contents and lessons will be housed in a central server.', 'Total': 7, 'BA': 1, 'Code and Unit Testing': 4}, {'Buffered': 122.5, 'Testing and Debugging': 21, 'Design': 14, 'Features': 'Add Academic Cooridnator role', 'Effort': 'H', 'Notes': '- All contents and lessons will be housed in a central server.', 'Total': 122.5, 'BA': 17.5, 'Code and Unit Testing': 70}, {'Buffered': 14, 'Testing and Debugging': 2.4, 'Design': 1.6, 'Features': 'Rename Local admin and Teacher', 'Effort': 'M', 'Notes': '- All contents and lessons will be housed in a central server.', 'Total': 14, 'BA': 2, 'Code and Unit Testing': 8}, {'Buffered': 70, 'Testing and Debugging': 12, 'Design': 8, 'Features': 'Media player', 'Effort': 'M', 'Notes': "- User would like to play the video content that is stored locally in a server.\n- The media player will let the user play/pause/seek a video that's available in the resource library or lesson.", 'Total': 70, 'BA': 10, 'Code and Unit Testing': 40}]}

    dct_total = {'Code and Unit Testing':0,
                 'Design':0,
                 'Testing and Debugging':0,
                 'BA':0,
                 'Total':0,
                 'Buffered':0,
                }

    int_row_id = 0
    worksheet.write(int_row_id,0,'Features',headerStyle)
    worksheet.write(int_row_id,1,'Notes',headerStyle)
    worksheet.write(int_row_id,2,'Code and Unit Testing',headerStyle)
    worksheet.write(int_row_id,3,'Design',headerStyle)
    worksheet.write(int_row_id,4,'Testing and Debugging',headerStyle)
    worksheet.write(int_row_id,5,'BA',headerStyle)
    worksheet.write(int_row_id,6,'Total',headerStyle)
    worksheet.write(int_row_id,7,'Buffered',headerStyle)
    worksheet.write(int_row_id,8,'Effort',headerStyle)

    for data in enumerate(dct_data['posts']):
        int_row_id = data[0]+1
        worksheet.write(int_row_id,0,data[1]['Features'])
        worksheet.write(int_row_id,1,data[1]['Notes'])
        worksheet.write(int_row_id,2,data[1]['Code and Unit Testing'],dataStyle)
        worksheet.write(int_row_id,3,data[1]['Design'],dataStyle)

        #Code commented for excel operation
        # worksheet.write(int_row_id,3,'=C2*20/100',dataStyle)

        worksheet.write(int_row_id,4,data[1]['Testing and Debugging'],dataStyle)
        worksheet.write(int_row_id,5,data[1]['BA'],dataStyle)
        worksheet.write(int_row_id,6,data[1]['Total'],dataStyle)
        worksheet.write(int_row_id,7,data[1]['Buffered'],dataStyle)
        if data[1]['Effort']:
            if data[1]['Effort'].strip() == 'H':
                worksheet.write(int_row_id,8,data[1]['Effort'],highStyle)
            elif data[1]['Effort'].strip() == 'M':
                worksheet.write(int_row_id,8,data[1]['Effort'],mediumStyle)
            else:
                worksheet.write(int_row_id,8,data[1]['Effort'],effortStyle)

        dct_total['Code and Unit Testing'] +=  float(data[1]['Code and Unit Testing'])
        dct_total['Design'] += float(data[1]['Design'])
        dct_total['Testing and Debugging'] +=  float(data[1]['Testing and Debugging'])
        dct_total['BA'] += float(data[1]['BA'])
        dct_total['Total'] += float(data[1]['Total'])
        dct_total['Buffered'] += float(data[1]['Buffered'])

    int_row_id += 1
    worksheet.write(int_row_id,0,'Total',trailerStyle)
    worksheet.write(int_row_id,1,'',trailerStyle)
    worksheet.write(int_row_id,2,str(dct_total['Code and Unit Testing']),totalStyle)
    worksheet.write(int_row_id,3,str(dct_total['Design']),totalStyle)
    worksheet.write(int_row_id,4,str(dct_total['Testing and Debugging']),totalStyle)
    worksheet.write(int_row_id,5,str(dct_total['BA']),totalStyle)
    worksheet.write(int_row_id,6,str(dct_total['Total']),totalStyle)
    worksheet.write(int_row_id,7,str(dct_total['Buffered']),totalStyle)

    ###########################################################################

    worksheet2 = workbook.add_worksheet()
    worksheet2.set_column('A:A', 20)
    worksheet2.set_column('B:B', 20)
    bold = workbook.add_format({'bold': 1})

    # Add the worksheet data that the charts will refer to.
    headings = ['Category', 'Values']
    data = [
        ['Development', 'Design', 'Testing','BA'],
        [dct_total['Code and Unit Testing'], dct_total['Design'], dct_total['Testing and Debugging'],dct_total['BA']],
    ]

    #worksheet2.write_row('A1', headings, bold)
    #worksheet2.write_column('A2', data[0])
    #worksheet2.write_column('B2', data[1])

    worksheet2.write(0,0,'Particulars',headerStyle)
    worksheet2.write(1,0,'Development')
    worksheet2.write(2,0,'Design')
    worksheet2.write(3,0,'Testing')
    worksheet2.write(4,0,'BA')

    worksheet2.write(0,1,'Effort',headerStyle)
    worksheet2.write(1,1,dct_total['Code and Unit Testing'])
    worksheet2.write(2,1,dct_total['Design'])
    worksheet2.write(3,1,dct_total['Testing and Debugging'])
    worksheet2.write(4,1,dct_total['BA'])
    #######################################################################
    #
    # Create a new chart object.
    #
    chart1 = workbook.add_chart({'type': 'pie'})

    # Configure the series. Note the use of the list syntax to define ranges:
    chart1.add_series({
        'name': 'Pie sales data',
        'categories': '=Sheet2!$A$2:$A$5',
        'values':  '=Sheet2!$B$2:$B$5',
    })

    # Add a title.
    chart1.set_title({'name': 'Effort Overview'})

    # Set an Excel chart style. Colors with white outline and shadow.
    chart1.set_style(10)

    # Insert the chart into the worksheet (with an offset).
    worksheet2.insert_chart('C2', chart1, {'x_offset': 50, 'y_offset': 15})

    filename = '/var/www/hackathon/excel/Project_estimation.xlsx'
    workbook.close()
    return send_file(filename,attachment_filename='Project_estimation.xlsx',as_attachment=True)

if __name__ == '__main__':
    app.run('0.0.0.0',1111,debug=True)
